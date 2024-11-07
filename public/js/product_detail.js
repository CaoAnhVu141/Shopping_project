document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const formElement = document.querySelector('#form-review');
    const reviewContainer = document.querySelector('#review-info');
    let editMode = false;  // Biến xác định chế độ chỉnh sửa
    let currentReviewId = null;  // ID đánh giá đang chỉnh sửa

    if (!formElement) return;

    // Xử lý submit form cho cả thêm mới và chỉnh sửa
    formElement.addEventListener('submit', function (event) {
        event.preventDefault();

        const rating = document.querySelector('input[name="rating"]');
        const comment = document.querySelector('textarea[name="review"]');
        const ratingError = document.getElementById('rating-error');
        const commentError = document.getElementById('comment-error');

        if (!rating || !comment) return;
        if (!ratingError || !commentError) return;

        const ratingValue = rating.value;
        const commentValue = comment.value;

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
                        // Cập nhật đánh giá hiện có trong DOM
                        const reviewElement = document.querySelector(`[data-review-id="${currentReviewId}"]`);
                        reviewElement.querySelector('.stext-102.cl6').innerText = data.review.comment;
                        reviewElement.querySelector('.fs-18.cl11').innerHTML =
                            '<i class="zmdi zmdi-star"></i>'.repeat(data.review.rating) +
                            '<i class="zmdi zmdi-star-outline"></i>'.repeat(5 - data.review.rating);
                    } else {
                        // Thêm review mới vào DOM
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
                        assignEvents(); // Gán sự kiện cho các biểu tượng xóa và sửa
                    }

                    // Reset form và biến edit mode
                    editMode = false;
                    currentReviewId = null;
                    ratingError.innerText = '';
                    commentError.innerText = '';
                    formElement.reset();
                } else if (data.errors) {
                    if (data.errors.rating) {
                        ratingError.innerText = data.errors.rating[0];
                    }
                    if (data.errors.comment) {
                        commentError.innerText = data.errors.comment[0];
                    }
                }
            })
            .catch(error => console.log('Error: ', error));
    });

    // Hàm xử lý xóa review
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
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Hàm gán sự kiện xóa và chỉnh sửa cho các biểu tượng
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

    // Hàm xử lý sự kiện xóa khi nhấp vào biểu tượng
    function handleDeleteClick(event) {
        const reviewId = event.target.getAttribute('data-id');
        if (confirm("Bạn muốn xóa đánh giá này?")) {
            deleteReview(reviewId);
        }
    }

    // Hàm xử lý sự kiện chỉnh sửa khi nhấp vào biểu tượng
    function handleEditClick(event) {
        const reviewId = event.target.getAttribute('data-id');
        const reviewElement = document.querySelector(`[data-review-id="${reviewId}"]`);
        const rating = reviewElement.querySelectorAll('.zmdi-star').length;
        const comment = reviewElement.querySelector('.stext-102.cl6').innerText;

        document.querySelector('input[name="rating"]').value = rating;
        document.querySelector('textarea[name="review"]').value = comment;

        editMode = true;
        currentReviewId = reviewId;
    }

    // Gán sự kiện xóa và chỉnh sửa khi tải trang
    assignEvents();
});
