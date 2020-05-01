/**
 * demo1.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2017, Codrops
 * http://www.codrops.com
 */
{
	const DOM = {};
	DOM.svg = document.querySelector('.morph');
	DOM.shapeEl = DOM.svg.querySelector('path');
	DOM.contentElems = Array.from(document.querySelectorAll('.content-wrap'));
	DOM.contentLinks = Array.from(document.querySelectorAll('.content__link'));
	DOM.footer = document.querySelector('.content--related');
	const contentElemsTotal = DOM.contentElems.length;
	const shapes = [
		{
			path: 'M 262.9,252.2 C 210.1,338.2 212.6,487.6 288.8,553.9 372.2,626.5 511.2,517.8 620.3,536.3 750.6,558.4 860.3,723 987.3,686.5 1089,657.3 1168,534.7 1173,429.2 1178,313.7 1096,189.1 995.1,130.7 852.1,47.07 658.8,78.95 498.1,119.2 410.7,141.1 322.6,154.8 262.9,252.2 Z',
			pathAlt: 'M 262.9,252.2 C 210.1,338.2 273.3,400.5 298.5,520 323.7,639.6 511.2,537.2 620.3,555.7 750.6,577.8 872.2,707.4 987.3,686.5 1102,665.6 1218,547.8 1173,429.2 1128,310.6 1096,189.1 995.1,130.7 852.1,47.07 658.8,78.95 498.1,119.2 410.7,141.1 322.6,154.8 262.9,252.2 Z',
			scaleX: 1.2,
			scaleY: 1,
			rotate: 0,
			tx: 0,
			ty: -60,
			fill: {
				duration: 500,
				easing: 'linear'
			},
			animation: {
				path: {
					duration: 100,
					easing: 'easeOutElastic',
					elasticity: 100
				},
				svg: {
					duration: 100,
					easing: 'easeOutElastic'
				}
			}
		},
		{
			path: 'M 262.9,252.2 C 210.1,338.2 212.6,487.6 288.8,553.9 372.2,626.5 511.2,517.8 620.3,536.3 750.6,558.4 860.3,723 987.3,686.5 1089,657.3 1168,534.7 1173,429.2 1178,313.7 1096,189.1 995.1,130.7 852.1,47.07 658.8,78.95 498.1,119.2 410.7,141.1 322.6,154.8 262.9,252.2 Z',
			pathAlt: 'M 262.9,252.2 C 210.1,338.2 273.3,400.5 298.5,520 323.7,639.6 511.2,537.2 620.3,555.7 750.6,577.8 872.2,707.4 987.3,686.5 1102,665.6 1218,547.8 1173,429.2 1128,310.6 1096,189.1 995.1,130.7 852.1,47.07 658.8,78.95 498.1,119.2 410.7,141.1 322.6,154.8 262.9,252.2 Z',
			scaleX: 1.5,
			scaleY: 1,
			rotate: -20,
			tx: 0,
			ty: -50,
			fill: {
				color: '#E0E8FC',
				duration: 500,
				easing: 'linear'
			},
			animation: {
				path: {
					duration: 100,
					easing: 'easeOutQuad',
					elasticity: 100
				},
				svg: {
					duration: 100,
					easing: 'easeOutElastic'
				}
			}
		},
	];
	let step;

	const initShapeLoop = function(pos) {
		pos = pos || 0;
		anime.remove(DOM.shapeEl);
		anime({
			targets: DOM.shapeEl,
			easing: 'linear',
			d: [{value: shapes[pos].pathAlt, duration:1500}, {value: shapes[pos].path, duration:1500}],
			loop: true,
			fill: {
				value: shapes[pos].fill.color,
				duration: shapes[pos].fill.duration,
				easing: shapes[pos].fill.easing
			},
			direction: 'alternate'
		});
	};

	const initShapeEl = function() {
		anime.remove(DOM.svg);
		anime({
			targets: DOM.svg,
			duration: 1,
			easing: 'linear',
			scaleX: shapes[0].scaleX,
			scaleY: shapes[0].scaleY,
			translateX: shapes[0].tx+'px',
			translateY: shapes[0].ty+'px',
			rotate: shapes[0].rotate+'deg'
		});

		initShapeLoop();
	};

	const createScrollWatchers = function() {
		DOM.contentElems.forEach((el,pos) => {
			const scrollElemToWatch = pos ? DOM.contentElems[pos] : DOM.footer;
			pos = pos ? pos : contentElemsTotal;
			const watcher = scrollMonitor.create(scrollElemToWatch,-300);
			watcher.enterViewport(function() {
				step = pos;
				anime.remove(DOM.shapeEl);
				anime({
					targets: DOM.shapeEl,
					duration: shapes[pos].animation.path.duration,
					easing: shapes[pos].animation.path.easing,
					elasticity: shapes[pos].animation.path.elasticity || 0,
					d: shapes[pos].path,
					fill: {
						value: shapes[pos].fill.color,
						duration: shapes[pos].fill.duration,
						easing: shapes[pos].fill.easing
					},
					complete: function() {
						initShapeLoop(pos);
					}
				});

				anime.remove(DOM.svg);
				anime({
					targets: DOM.svg,
					duration: shapes[pos].animation.svg.duration,
					easing: shapes[pos].animation.svg.easing,
					elasticity: shapes[pos].animation.svg.elasticity || 0,
					scaleX: shapes[pos].scaleX,
					scaleY: shapes[pos].scaleY,
					translateX: shapes[pos].tx+'px',
					translateY: shapes[pos].ty+'px',
					rotate: shapes[pos].rotate+'deg'
				});
			});

			watcher.exitViewport(function() {
				const idx = !watcher.isAboveViewport ? pos-1 : pos+1;
				if( idx <= contentElemsTotal && step !== idx ) {
					step = idx;
					anime.remove(DOM.shapeEl);
					anime({
						targets: DOM.shapeEl,
						duration: shapes[idx].animation.path.duration,
						easing: shapes[idx].animation.path.easing,
						elasticity: shapes[idx].animation.path.elasticity || 0,
						d: shapes[idx].path,
						fill: {
							value: shapes[idx].fill.color,
							duration: shapes[idx].fill.duration,
							easing: shapes[idx].fill.easing
						},
						complete: function() {
							initShapeLoop(idx);
						}
					});

					anime.remove(DOM.svg);
					anime({
						targets: DOM.svg,
						duration: shapes[idx].animation.svg.duration,
						easing: shapes[idx].animation.svg.easing,
						elasticity: shapes[idx].animation.svg.elasticity || 0,
						scaleX: shapes[idx].scaleX,
						scaleY: shapes[idx].scaleY,
						translateX: shapes[idx].tx+'px',
						translateY: shapes[idx].ty+'px',
						rotate: shapes[idx].rotate+'deg'
					});
				}
			});
		});
	};

	const init = function() {
		imagesLoaded(document.body, () => {
			initShapeEl();
			createScrollWatchers();
			Array.from(document.querySelectorAll('.content--layout')).forEach(el => new TiltObj(el));
			// Remove loading class from body
			document.body.classList.remove('loading');
		});
	}

	init();
};