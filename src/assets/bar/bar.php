<?php

/**
 * @package    phalcon-debugbar
 * @author     Milan Kyncl <milan@friendlystudio.cz>
 * @date 29.10.17
 */

return function($panels) { ?>

<div id="mk-phalcon-debugbar" class="mk-phalcon-debugbar" style="display: none">
	<ul class="panel-row">
        <li style="background-color: #2B2F3E">
            <svg width="22" height="22" class="phalcon-logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255.1 291.62"><path d="M203.57,139.86L185.83,104.1,191.48,128Z" fill="#73b08f"/><path d="M182.74,91.57l13.7,57.88-44.06-46.56L88.18,43,71.8,0Z" fill="#c5e4d3"/><path d="M155.92,104.32L98.22,76.66,66.73,42.83,62.61,20.54Z" fill="#76c39b"/><path d="M200.05,152L145.59,138.1,40.85,77.85,0,21.79l157.11,83.3Z"/><path d="M143.09,136.5v1.61l-7,13.14L99.32,139.18,31.06,88,4.48,49.9,35,68.13l4.69,7.24Z" fill="#73b08f"/><path d="M44.12,98L39,97.42l-17.79-6.5,36.42,33.37,9.6,7.38,38.11,12.7Z" stroke="#000" stroke-width="1.12"/><path d="M193.43,149.5h0l-0.77,29.57-2.83-4.83-16.46-1.14L135.3,151.2,144,135.85Z" fill="#76c39b"/><path d="M38.5,116.92l47.39,36.21,49.22,16.38,38,3.45-37.7-21.84Z" fill="#c5e4d3"/><path d="M61.48,145.77L94.4,164l38.33,3.86-46.3-14.4L79,148.86Z" fill="#76c39b"/><path d="M134.64,167.15l-53.87-4.7,27.75,10.65,18.23,2.51Z" fill="#73b08f"/><path d="M122.44,175.46l-4.63.68L96.2,179.21,106.75,172Z" fill="#76c39b"/><path d="M156.95,180.12L155.89,182,77,227.69,61.48,248.26,67,226.08l17.14-23.51,49.05-33.13Z" fill="#76c39b"/><path d="M70.74,202.62L56.85,220.88v-8Z"/><path d="M185.2,183.33l-52.73,35.75-4.37-7.46-18.26,38.58,4.12,5.66L117,291.62l-22.12-40.9,18-44.24,44-27.27Z" fill="#c5e4d3"/><path d="M112.92,205.71l-35.24,19-1,26.24,10.8,35.24v-18Z"/><path d="M69.19,256.12l0.51,1.8,4.63,19.55-6.17-3.86Z" fill="#73b08f"/><path d="M133.38,216.57l-4.73-5.83-19.74,37.39,31.42,41.1-7.79-18.3Z" fill="#73b08f"/><path d="M137.1,214.34L133,216.5l-0.26,44.79,7.72,16.19,14.4-5.4-0.51-10.79L138.64,245.9Z" fill="#76c39b"/><path d="M208.13,182.78l-23.92,6.69-26,22.12-14.15-.51L185,183.55Z"/><path d="M198.3,185.73l-7.5-13.79-67.47-5.28,30.25,12.62Z" fill="#73b08f"/><path d="M159,210.73l3.34,7.89,7.2,5.17h1.29l-0.51,8.43-22.12,9.25-7.46-17.13-2.06-10.06,6.69-5.44Z" fill="#73b08f"/><path d="M170.8,255.09l-13.38-5.92-5.14,10.55,1.8,2.57-0.26,11.32,9.77,11.06-1.54-20.84,2.32-1,7.72,7.46-3.6-8.49-8.23-4.37,1.8-3.09,8.75,3.86v-3.09Z"/><path d="M174.14,211.11L169,223.45,170,234l10.55,13.12L179.29,226l1.54-1,8.23,7.2-3.34-8-9.26-4.89,1.54-2.57,9.52,4.12-0.26-3.6Z"/><path d="M221.73,156.58l-28.55-6.69v26.75l3.34,5.92,25.21,0.26L245.65,191l-0.77-3.34-14.66-8.49-29.32-11.58,16.72-.26-16.21-7.46Z" fill="#c5e4d3"/><path d="M255,181l-10.8-17.49-24.69-7.46L200,159.68l15.43,7.72-14.4.51,27,11.58,15.43,7.46Z" fill="#73b08f"/><path d="M241,201.85l4.12-6.17-3.09-8,12.86-7.2,0.26,14.66-7.72,6.95Z"/><path d="M251.26,178.84l-8.83-4.12-4.71,4.12" stroke="#000" stroke-width="0.3"/></svg>
        </li>

		<?php foreach($panels as $panel): ?>

            <li>
                <a href="javascript:void(0);">
                    <div class="debugbar-icon">
                        <?= $panel->getIcon() ?>
                    </div>
                    <span class="debugbar-label"><?= $panel->getLabel() ?></span>
                </a>

                <?php if(method_exists($panel, 'getWindowContent')): ?>
                <div class="debugbar-window">

                    <div class="title"><?= $panel->getTitle() ?></div>

                    <?= $panel->getWindowContent() ?>

                </div>
                <?php endif ?>
            </li>

		<?php endforeach ?>

        <li>
            <a href="#" id="close-mk-phalcon-debugbar">
                <svg class="close-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 63.55"><path d="M28.94,31.79L0.61,60.11A2,2,0,1,0,3.46,63L32,34.42,60.54,63a2,2,0,0,0,2.85-2.85L35.06,31.79,63.41,3.44A2,2,0,0,0,60.56.59L32,29.15,3.44,0.59A2,2,0,0,0,.59,3.44Z" transform="translate(0 0)" stroke-width="3" fill="#fff"/></svg>
            </a>
        </li>
	</ul>
</div>
    <style>
        .mk-phalcon-debugbar {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            color: #fff;
            background: #D83D5B;
            border-top-right-radius: 4px;
            z-index: 1000;
        }

        .mk-phalcon-debugbar .panel-row {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: stretch;
            -webkit-align-items: stretch;
            -ms-flex-align: stretch;
            align-items: stretch;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -webkit-flex-direction: row;
            -ms-flex-direction: row;
            flex-direction: row;
            list-style: none;
            margin: 0;
            padding: 0
        }

        .mk-phalcon-debugbar .panel-row li {
            position: relative;
            -webkit-flex-basis: auto;
            -ms-flex-preferred-size: auto;
            flex-basis: auto;
            display: -webkit-inline-box;
            display: -webkit-inline-flex;
            display: -ms-inline-flexbox;
            display: inline-flex
        }

        .mk-phalcon-debugbar .panel-row li a {
            min-height: 100%;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            padding: 0 6px;
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -webkit-flex-direction: row;
            -ms-flex-direction: row;
            flex-direction: row;
            text-decoration: none;
            color: #222;
            font-weight: 500;
        }

        .mk-phalcon-debugbar .panel-row li a:hover {
            background-color: #c23651
        }

        .mk-phalcon-debugbar .phalcon-logo {
            margin: 4px 8px;
            height: 18px;
            width: 18px;
            display: inline-block;
            fill: #000 !important;
        }

        .mk-phalcon-debugbar .close-icon {
            height: 7px;
            width: 7px;
            margin: 0 4px
        }

        .mk-phalcon-debugbar .debugbar-icon {
            display: inline-block;
            margin-right: 4px;
            vertical-align: middle
        }

        .mk-phalcon-debugbar .debugbar-icon svg {
            height: 14px;
            width: 14px;
            display: block
        }

        .mk-phalcon-debugbar .debugbar-label {
            display: inline-block;
            -webkit-font-smoothing: antialiased;
            font-size: 13px;
            color: #fff;
            font-family: Tahoma, sans-serif;
            vertical-align: middle;
            font-weight: 500;
            margin-left: 2px;
        }

        .mk-phalcon-debugbar .debugbar-window {

            display: none;

            position: absolute;
            bottom: calc(100% + 20px);
            left: 0;
            height: auto;
            background-color: #fff;
            width: 450px;
            color: #eee;
            font-size: 12px;
            overflow-y: auto;
            max-height: 400px;
            font-family: Tahoma, sans-serif;
            -webkit-font-smoothing: antialiased;

            z-index: 100;
        }
        .mk-phalcon-debugbar .panel-row li::after {

            content: '';
            position: absolute;
            bottom: 100%;
            left: 0;
            width: 100%;
            height: 20px;
            display: none;
        }

        .mk-phalcon-debugbar .panel-row li:hover::after {

            display: block;
        }

        .mk-phalcon-debugbar .panel-row li:hover .debugbar-window {

            display: block;
        }

        .mk-phalcon-debugbar .debugbar-window .title {

            background-color: #c23651;
            margin: -1px;
            color: #fff;
            font-weight: bold;
            padding: 8px;
            display: block;
            text-align: left;

        }

        .mk-phalcon-debugbar .debugbar-window table {

            width: 100%;
        }

        .mk-phalcon-debugbar .debugbar-window table td,
        .mk-phalcon-debugbar .debugbar-window table th {

            padding: 6px 8px;
            text-align: left;
            font-weight: 400;
        }
        .mk-phalcon-debugbar .debugbar-window table th {
            font-weight: bold;
        }

        .mk-phalcon-debugbar .debugbar-window table td.code {

            font-weight: 300;
            font-family: monospace;
        }

        .mk-phalcon-debugbar .debugbar-window tbody tr {

            background: #2B2F3E;
        }

        .mk-phalcon-debugbar .debugbar-window table tr:nth-of-type(odd) {

            background: #232733;
        }


        .mk-phalcon-debugbar .debugbar-window table tr.highlighted {

            background-color: rgba(194, 54, 81, 0.78);
        }

    </style>
    <script type="text/javascript" src="?mk_debugbar_assets=js"></script>

<?php }?>