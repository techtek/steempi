<?php

/**
 * @param int $limit
 * @return mixed|\Psr\Http\Message\ResponseInterface
 */
function getFeed($limit = 20)
{
    $Feed = SteemPi\SteemPi::getModuleHandler()->getModule('feed');

    $tags      = $Feed->getSetting('feed', 'filter-tags');
    $userNames = $Feed->getSetting('feed', 'filter-usernames');
    $query     = array();

    if (!empty($tags)) {
        $tags = preg_replace('/[^A-Za-z0-9\-]/', '', $tags);
        $tags = explode(' ', $tags);


        foreach ($tags as $tag) {
            $query[] = 'tags:'.$tag;
        }
    }

    if (!empty($userNames)) {
        $userNames = str_replace('@', '', $userNames);
        $userNames = str_replace(',', ' ', $userNames);
        $userNames = str_replace(';', ' ', $userNames);
        $userNames = preg_replace('/\s+/', ' ', $userNames);
        $userNames = explode(' ', $userNames);

        foreach ($userNames as $username) {
            $query[] = 'author:'.$username;
        }
    }

    if (empty($query)) {
        $query[] = 'tags:steempi';
    }

    $Client = new GuzzleHttp\Client();

    return $Client->request('GET', 'https://api.asksteem.com/search', [
        'query' => [
            'q'       => implode(' ', $query),
            'order'   => 'desc',
            'sort_by' => 'created',
            'include' => 'meta',
            'limit'   => $limit
        ]
    ]);
}

/**
 * @param $entry
 * @return string
 */
function parseFeedItemToArticle($entry)
{
    $description = strip_tags($entry['summary']);
    $category    = $entry['tags'][0];

    $entry['pending_payout_value'] = 0;

    if (mb_strlen($description) > 120) {
        $description = mb_substr($description, 0, 120).'...';
    }

    $link = 'https://steemit.com/';
    $link .= $category.'/';
    $link .= '@'.$entry['author'].'/';
    $link .= $entry['permlink'];

    $image = '';

    if (isset($entry['meta']['image'])) {
        $image = '<img src="'.$entry['meta']['image'][0].'"/>';
    }

    $result = '
            <article class="feed-tile"
                 data-link="'.$link.'"
                 data-permlink="'.$entry['permlink'].'"
                 data-author="'.$entry['author'].'"
            >
            <div class="feed-tile-container">
                <div class="feed-tile-image">'.$image.'</div>
                
                <div class="feed-tile-info">
                    <header>
                        <h1>'.$entry['title'].'</h1>
                    </header>
                    <p>'.$description.'</p>
                </div>
                
                <div class="feed-tile-action">
                    <span class="feed-tile-action-vote">
                        <span class="fa fa-arrow-circle-o-up"></span>
                        <span>'.$entry['pending_payout_value'].'</span>
                    </span>
                
                    <span class="feed-tile-action-view">
                        <span class="fa fa-hand-o-up"></span>
                        <span>'.$entry['net_votes'].'</span>
                    </span>
                </div>
            </div>
            </article>';

    return $result;
}
