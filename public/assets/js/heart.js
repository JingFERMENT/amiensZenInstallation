// target the heart element
const heart = document.getElementById('heart');

// creat the function for like or unlike a post
const likeUnlikePost = function () {
  // unlike the post
  if (heart.classList.contains('like')) {
    heart.classList.remove('like');
    heart.classList.add('unlike');
  // like the post
  } else {
    heart.classList.remove('unlike');
    heart.classList.add('like');
  }
}

heart.addEventListener('click', likeUnlikePost); 