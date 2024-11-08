document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const formElement = document.querySelector('#form-review');
    const reviewContainer = document.querySelector('#review-info');
    const ratingError = document.getElementById('rating-error');
    const commentError = document.getElementById('comment-error');
    const stars = document.querySelectorAll('.custom-rating .star');
    let editMode = false;
    let currentReviewId = null;

    if (!formElement) return;

    // Star rating selection logic
    stars.forEach(star => {
        star.addEventListener('click', handleStarClick);
        star.addEventListener('mouseover', handleStarHover);
    });

    document.querySelector('.custom-rating').addEventListener('mouseleave', handleStarLeave);

    function handleStarClick(event) {
        const value = event.target.getAttribute('data-value');
        setRating(value);
        document.getElementById('ratingInput').value = value;
    }

    function handleStarHover(event) {
        const value = event.target.getAttribute('data-value');
        setRating(value);
    }

    function handleStarLeave() {
        const ratingValue = document.getElementById('ratingInput').value;
        setRating(ratingValue);
    }

    function setRating(value) {
        stars.forEach(star => {
            const starValue = star.getAttribute('data-value');
            star.classList.toggle('filled', starValue <= value);
        });
    }

    formElement.addEventListener('submit', function (event) {
        event.preventDefault();

        const ratingValue = document.getElementById('ratingInput').value;
        const commentValue = document.querySelector('textarea[name="review"]').value;

        if (!ratingValue) {
            ratingError.innerText = 'Please select a rating.';
            return;
        } else {
            ratingError.innerText = '';
        }

        if (!commentValue) {
            commentError.innerText = 'Please enter a comment.';
            return;
        } else {
            commentError.innerText = '';
        }

        const reviewData = {
            id_product: 1,
            rating: ratingValue,
            comment: commentValue,
        };

        const url = editMode ? `/reviews/${currentReviewId}` : '/submit-review';
        const method = editMode ? 'PUT' : 'POST';

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(reviewData)
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (editMode) {
                        const reviewElement = document.querySelector(`[data-review-id="${currentReviewId}"]`);
                        reviewElement.querySelector('.stext-102.cl6').innerText = data.review.comment;
                        reviewElement.querySelector('.fs-18.cl11').innerHTML =
                            '<i class="zmdi zmdi-star"></i>'.repeat(data.review.rating) +
                            '<i class="zmdi zmdi-star-outline"></i>'.repeat(5 - data.review.rating);
                    } else {
                        const newReviewHtml = `
                        <div class="flex-w flex-t p-b-68" data-review-id="${data.review.id_review}">
                            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                <img src="images/avatar-01.jpg" alt="AVATAR">
                            </div>
                            <div class="size-207">
                                <div class="flex-w flex-sb-m p-b-17">
                                    <span class="mtext-107 cl2 p-r-20">
                                        ${data.customer.name}
                                    </span>
                                    <span class="fs-18 cl11">
                                        ${'<i class="zmdi zmdi-star"></i>'.repeat(data.review.rating)}
                                    </span>
                                </div>
                                <p class="stext-102 cl6">${data.review.comment}</p>
                                <div class="review-actions">
                                    <i class="zmdi zmdi-edit edit-icon" data-id="${data.review.id_review}" style="cursor: pointer;"></i>
                                    <i class="zmdi zmdi-delete delete-icon" data-id="${data.review.id_review}" style="cursor: pointer; margin-left: 10px;"></i>
                                </div>
                            </div>
                        </div>`;
                        reviewContainer.innerHTML += newReviewHtml;
                        assignEvents();
                    }

                    editMode = false;
                    currentReviewId = null;
                    formElement.reset();
                    setRating(0);
                }
            })
            .catch(error => console.log('Error: ', error));
    });

    // Define the deleteReview function
    function deleteReview(reviewId) {
        fetch(`/reviews/${reviewId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const reviewElement = document.querySelector(`[data-review-id="${reviewId}"]`);
                    if (reviewElement) {
                        reviewElement.remove();
                    }
                } else {
                    console.log('Failed to delete review:', data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function assignEvents() {
        document.querySelectorAll('.delete-icon').forEach(icon => {
            icon.removeEventListener('click', handleDeleteClick);
            icon.addEventListener('click', handleDeleteClick);
        });

        document.querySelectorAll('.edit-icon').forEach(icon => {
            icon.removeEventListener('click', handleEditClick);
            icon.addEventListener('click', handleEditClick);
        });
    }

    function handleDeleteClick(event) {
        const reviewId = event.target.getAttribute('data-id');
        if (confirm("Bạn muốn xóa đánh giá này?")) {
            deleteReview(reviewId);
        }
    }

    function handleEditClick(event) {
        const reviewId = event.target.getAttribute('data-id');
        const reviewElement = document.querySelector(`[data-review-id="${reviewId}"]`);
        const rating = reviewElement.querySelectorAll('.zmdi-star').length;
        const comment = reviewElement.querySelector('.stext-102.cl6').innerText;

        document.querySelector('textarea[name="review"]').value = comment;
        document.getElementById('ratingInput').value = rating;
        setRating(rating);

        editMode = true;
        currentReviewId = reviewId;
    }

    assignEvents();
});
