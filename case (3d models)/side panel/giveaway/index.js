var Form   = document.querySelector('Form');
var Input  = document.querySelector('[name="url"]');
var Result = document.querySelector('.result');

var Registrations = document.querySelector('.registrations');

/**
 * Read the users and generate the list
 *
 * @param {String} author
 * @param {String} permlink
 * @return Promise
 */
function generate(author, permlink) {
    return new Promise(function (resolve) {
        console.log('fetch follower');

        Promise.all([
            getFollower('dehenne'),
            getFollower('techtek')
        ]).then(function (result) {
            var getUsernames = function (follower) {
                return follower.follower;
            };

            var intersect = function (a, b) {
                var sorted_a = a.concat().sort();
                var sorted_b = b.concat().sort();
                var common   = [];
                var a_i      = 0;
                var b_i      = 0;

                while (a_i < a.length && b_i < b.length) {
                    if (sorted_a[a_i] === sorted_b[b_i]) {
                        common.push(sorted_a[a_i]);
                        a_i++;
                        b_i++;
                    } else if (sorted_a[a_i] < sorted_b[b_i]) {
                        a_i++;
                    } else {
                        b_i++;
                    }
                }

                return common;
            };

            var dehenne = result[0].map(getUsernames);
            var techtek = result[1].map(getUsernames);

            // these are followers which follow dehenne AND techtek
            var intersection = intersect(dehenne, techtek);

	    console.log('Fetch resteems');

            getResteemUsers(Input.value).then(function (users) {
                console.warn('Resteems: '+ users.length);

		var html = ''

		html = html + '<h1>Registrations</h1>'
		html = html + '<ul>';
		var giveaway = intersect(intersection, users);
		//console.warn(giveaway);

		for (var i = 0, len = giveaway.length; i < len; i++) {
			html = html + '<li>@'+ giveaway[i] +'</li>'
		}

		html = html + '</ul>';

		Registrations.innerHTML = html;

		resolve();
            });
        });
    });
}

/**
 * Return the follower of an user
 *
 * @param {String} username
 * @return Promise
 */
function getFollower(username) {
    return new Promise(function (resolve) {
        steem.api.getFollowers(username, 0, 'blog', 1000, function (err, result) {
            resolve(result);
        });
    });
}

/**
 * Return the active votes
 *
 * @param {String} author
 * @param {String} permlink
 * @return Promise
 */
function getVotes(author, permlink) {
    return new Promise(function (resolve) {
        steem.api.getContent(author, permlink, function (err, result) {
            resolve(result.active_votes);
        });
    });
}


function getResteemUsers(url) {
	return new Promise(function(resolve) {
		url = url.replace('https://steemit.com', 'https://steemdb.com') +'/reblogs';

		fetch(url).then(function(Response) {
			return Response.text();
		}).then(function(result) {
			var Ghost = document.createElement('div');
			Ghost.innerHTML = result;

			var resteemed   = Ghost.querySelectorAll('.twelve .relaxed a');
			var result = [];

			for (var i = 0, len = resteemed.length; i < len; i++) {
				user = resteemed[i].innerHTML;
				user = user.trim();
				user = user.replace('@', '');

				result.push(user);
			}

			resolve(result);
		});
	});
}

/**
 * Return the active votes
 *
 * @param {String} author
 * @param {String} permlink
 * @return Promise
 */
//function getResteems(author, permlink) {
//    return new Promise(function (resolve) {
//        steem.api.getContent(author, permlink, function (err, result) {
//            console.warn(result);
//            resolve(result.active_votes);
//        });
//    });
//}

/**
 * Formula events
 */
Form.addEventListener('submit', function (event) {
    event.preventDefault();

    var value = Input.value,
        Url   = new URI(value);

    if (value.indexOf('https://steemit.com') === -1) {
        console.error('No Steemit Url');
        return;
    }

    var path  = Url.path(),
        parts = path.split('/');

    var author   = parts[2].replace('@', '');
    var permlink = parts[3];

    Result.style.display = '';

    generate(author, permlink).then(function () {
        Result.style.display = 'none';
    });
});
