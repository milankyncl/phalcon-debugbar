
/**
 * |-------------------------------------|
 * | MilanKyncl\PhalconDebugbar v. 1.0.0 |
 * |-------------------------------------|
 */

console.log('MilanKyncl/PhalconDebugbar version 1.0.0');

var debugBar = document.getElementById('mk-phalcon-debugbar'),
    closeDebugbar = document.getElementById('close-mk-phalcon-debugbar');


debugBar.style.display = 'block';

closeDebugbar.onclick = function() {

    debugBar.style.display = 'none';

    return false;

};