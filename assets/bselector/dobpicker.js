/**
 * jQuery DOB Picker
 * Website: https://github.com/tyea/dobpicker
 * Version: 1.0
 * Author: Tom Yeadon
 * License: BSD 3-Clause
 */

jQuery.extend({

	dobPicker: function(params) {

		// set the defaults		
		if (typeof(params.dayDefault) === 'undefined') params.dayDefault = 'Day';
		if (typeof(params.monthDefault) === 'undefined') params.monthDefault = 'Month';
		if (typeof(params.yearDefault) === 'undefined') params.yearDefault = 'Year';
		if (typeof(params.minimumAge) === 'undefined') params.minimumAge = 12;
		if (typeof(params.maximumAge) === 'undefined') params.maximumAge = 80;

		// set the default messages		
		$(params.daySelector).append('<option value="">' + params.dayDefault + '</option>');
		$(params.monthSelector).append('<option value="">' + params.monthDefault + '</option>');
		$(params.yearSelector).append('<option value="">' + params.yearDefault + '</option>');

		// populate the day select
		for (i = 1; i <= 31; i++) {
			if (i <= 9) {
				var val = '0' + i;
			} else {
				var val = i;
			}
			$(params.daySelector).append('<option value="' + val + '">' + i + '</option>');
		}

		// populate the month select		
		
		for (i = 1; i <= 12; i++) {
			if (i <= 9) {
				var val = '0' + i;
			} else {
				var val = i;
			}
			$(params.monthSelector).append('<option value="' + val + '">' + i + '</option>');
		}

		// populate the year select
		
		for (i = 1; i <= 100; i++) {
			if (i <= 9) {
				var val = '0' + i;
			} else {
				var val = i;
			}
			$(params.yearSelector).append('<option value="' + val + '">' + i + '</option>');
		}
		
	}
	
});
