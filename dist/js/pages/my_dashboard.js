/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

/* global moment:false, Chart:false, Sparkline:false */

$(function () {
	'use strict'

	/* Chart.js Charts */
	// Sales chart
	var aktualChartCanvas = document.getElementById('aktual-chart-canvas').getContext('2d')
	// $('#aktual-chart').get(0).getContext('2d');


	// var salesChartData = {
	// 	labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
	// 	datasets: [{
	// 			label: 'Digital Goods',
	// 			backgroundColor: 'rgba(60,141,188,0.9)',
	// 			borderColor: 'rgba(60,141,188,0.8)',
	// 			pointRadius: false,
	// 			pointColor: '#3b8bba',
	// 			pointStrokeColor: 'rgba(60,141,188,1)',
	// 			pointHighlightFill: '#fff',
	// 			pointHighlightStroke: 'rgba(60,141,188,1)',
	// 			data: [28, 48, 40, 19, 86, 27, 90, 20, 40, 60, 30, 90, 20]
	// 		},
	// 		{
	// 			label: 'Electronics',
	// 			backgroundColor: 'rgba(210, 214, 222, 1)',
	// 			borderColor: 'rgba(210, 214, 222, 1)',
	// 			pointRadius: false,
	// 			pointColor: 'rgba(210, 214, 222, 1)',
	// 			pointStrokeColor: '#c1c7d1',
	// 			pointHighlightFill: '#fff',
	// 			pointHighlightStroke: 'rgba(220,220,220,1)',
	// 			data: [65, 59, 80, 81, 56, 55, 40, 19, 86, 27, 90, 20, 40]
	// 		}
	// 	]
	// }


	var aktualChartOptions = {
		maintainAspectRatio: false,
		responsive: true,
		legend: {
			display: true
		},
		scales: {
			xAxes: [{
				gridLines: {
					display: true
				}
			}],
			yAxes: [{
				gridLines: {
					display: true
				}
			}]
		}
	}

	// This will get the first returned node in the jQuery collection.
	// eslint-disable-next-line no-unused-vars
	var salesChart = new Chart(aktualChartCanvas, { // lgtm[js/unused-local-variable]
		type: 'line',
		data: salesChartData,
		options: aktualChartOptions
	})

})
