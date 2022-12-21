/*$(document).ready(function() {
	var $range = $(".js-range-price"),
	    $from = $(".js-from"),
	    $to = $(".js-to"),
	    my_range,
	    min = $(".js-range-price").data("min"),
	    max = $(".js-range-price").data("max"),
	    from,
	    to;

	var updateValues = function () {
	    $from.prop("value", from);
	    $to.prop("value", to);
	};

	$range.ionRangeSlider({
	    onStart: function (data) {
			from = data.from;
	        to = data.to;
	        
	        updateValues();
	    },
	    onChange: function (data) {
	        from = data.from;
	        to = data.to;
	        
	        updateValues();
	    },
	    onFinish: function (data) {
	        from = data.from;
	        to = data.to;
	        
	        updateValues();
	    }
	});

	my_range = $range.data("ionRangeSlider");

	var updateRange = function () {
	    my_range.update({
	        from: from,
	        to: to
	    });
	};

	$(document).delegate($from, 'keyup', function(e){
	// $from.on("keyup", function () {
	    from = +$(this).prop("value");
	    if (from < min) {
	        from = min;
	    }
	    if (from > to) {
	        from = to;
	    }

	    updateValues();    
	    updateRange();
	});

	$(document).delegate($to, 'keyup', function(e){
	// $to.on("keyup", function () {
	    to = +$(this).prop("value");
	    if (to > max) {
	        to = max;
	    }
	    if (to < from) {
	        to = from;
	    }

	    updateValues();    
	    updateRange();
	});
});
*/