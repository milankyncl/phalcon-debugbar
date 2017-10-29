
/**
 * |-------------------------------------|
 * | MilanKyncl\PhalconDebugbar v. 1.0.0 |
 * |-------------------------------------|
 */

console.log('MilanKyncl/PhalconDebugbar version 1.0.0');


var head = document.head || document.getElementsByTagName('head')[0],
    link = document.createElement('link');

link.rel = 'stylesheet';
link.type = 'text/css';
link.href = '?mk_debugbar_assets=css';

head.appendChild(link);

link.onload = function() {

    var debugBar = document.getElementById('mk-phalcon-debugbar'),
        closeDebugbar = document.getElementById('close-mk-phalcon-debugbar');


    debugBar.style.display = 'block';

    closeDebugbar.onclick = function() {

        debugBar.style.display = 'none';

        return false;

    };

};