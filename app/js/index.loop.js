window.SteemPi.moduleLoop = false;

(function () {
    var LoopTimeput = null;
    var timer       = 10000;

    var Button     = document.querySelector('.header-buttons .module-loop');
    var Navigation = document.querySelector('nav .navigation');
    var modules    = [].slice.call(Navigation.querySelectorAll('li'));

    modules = modules.map(function (Node) {
        return Node.getAttribute('data-module');
    });

    /**
     * Return the next module
     *
     * @param module
     * @return {String}
     */
    var getNextModule = function (module) {
        var index = modules.indexOf(module);

        if (index === -1) {
            return modules[0];
        }

        if (typeof modules[index + 1] !== 'undefined') {
            return modules[index + 1];
        }

        return modules[0];
    };

    /**
     * Return the current module
     *
     * @return {String}
     */
    var getCurrent = function () {
        var hash = window.location.hash;

        if (hash === '' || hash === '#!') {
            return modules[0];
        }

        return hash.replace('#', '').replace('\!', '');
    };

    /**
     * Loops the module
     */
    var loop = function () {
        if (!window.SteemPi.moduleLoop) {
            return;
        }

        var PaceNode = document.querySelector('.pace');

        if (PaceNode) {
            var Progress = PaceNode.querySelector('.pace-progress');

            Progress.style.transform          = 'translate3d(0, 0px, 0px)';
            Progress.style.transitionDuration = (timer / 1000) + 's';
            PaceNode.className                = 'pace';

            setTimeout(function () {
                Progress.style.transform = 'translate3d(100%, 0px, 0px)';
            }, 10);

        }

        LoopTimeput = setTimeout(function () {
            var next = getNextModule(getCurrent());

            if (PaceNode) {
                var Progress = PaceNode.querySelector('.pace-progress');

                Progress.style.transitionDuration = '0s';
                Progress.style.transform          = 'translate3d(0, 0px, 0px)';
                PaceNode.classList.add('pace-inactive');
            }

            Router.navigate(next);
            setTimeout(loop, 200);
        }, timer);
    };

    // remove events -> workaround
    Button.addEventListener('click', function () {
        if (window.SteemPi.moduleLoop) {
            window.SteemPi.moduleLoop = false;

            if (LoopTimeput) {
                clearTimeout(LoopTimeput);
            }

            Button.classList.remove('active');

            var PaceNode = document.querySelector('.pace');

            if (PaceNode) {
                PaceNode.classList.add('pace-inactive');
            }

            return;
        }

        Button.classList.add('active');
        window.SteemPi.moduleLoop = true;

        loop();
    });
})();