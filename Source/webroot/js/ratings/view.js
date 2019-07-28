console.log('ratings/view.js');

var $semester = $('#semester');
var $ratingsContainer = $('#ratings-container');

function refreshEvents() {

	$('.star-rating.selectable').on({
		mouseleave: function () {
			var $this = $(this);
			$this.find('i.fa:not(.selected)').removeClass('fa-star').addClass('fa-star-o')
		}
	});

	$('.star-rating.selectable i').on({
		mouseenter: function () {
			var $this = $(this);
			var $parent = $this.parent();
			$parent.find('i.fa:not(.selected)').removeClass('fa-star').addClass('fa-star-o')
			$stars = $parent.find('i.fa').slice(0, $this.index() + 1);
			$stars.removeClass('fa-star-o').addClass('fa-star')
		},
		click: function () {
			var $this = $(this);
			var $parent = $this.parent();
			$parent.find('i.fa').removeClass('fa-star').removeClass('selected').addClass('fa-star-o')
			$stars = $parent.find('i.fa').slice(0, $this.index() + 1);
			$stars.addClass('selected').addClass('fa-star').removeClass('fa-star-o');
			$('#rating-stars').val($this.index() + 1);
		}
	});
}

function updateReviews() {
	var semId = $semester.val();
	var courseId = $semester.data('course-id');

	$.ajax({
		type: 'GET',
		url: '/course-semester-reviews/get_reviews.json',
		data: {'courseId': courseId, 'semesterId': semId}
	})
	.done(function (data) {
		if (data && data.ratings) {
			$ratingsContainer.html('');
			$ratingsContainer.append(data.ratings);
		}

		refreshEvents();
	});
}

$semester.change(updateReviews);

updateReviews();