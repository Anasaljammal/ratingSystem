var comments_containers = document.querySelectorAll('.comments-container');
var comments_btns = document.querySelectorAll('.comment-btn');
var close_btns = document.querySelectorAll('.close-btn');

for (let i = 0; i < comments_btns.length; i++) {
     comments_btns[i].addEventListener('click', () => {
          comments_containers[i].style.display = 'block';
     });
}

for (let i = 0; i < close_btns.length; i++) {
     close_btns[i].addEventListener('click', () => {
          comments_containers[i].style.display = 'none';
     });
}