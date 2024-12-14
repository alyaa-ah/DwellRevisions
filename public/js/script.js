document.addEventListener('DOMContentLoaded', function() {
  AOS.init();
});

$("#btnLogin").on('click', function(){
  $("#loginModal").modal('show');
});

$("#btnLogin").on('click', function(){
  $("#loginModal").modal('show');
});

$("#btnLogin").on('click', function(){
  $("#loginModal").modal('show');
});

$("#btnPreBookings").on('click', function(){
  $("#preBookingsModal").modal('show');
});

// $("#guestHouse-booking").on('click', function(){
//     $("#guestHouse-booking-modal").modal('show');
// });

$("#btnLogout").on('click', function(){
  $("#logoutModal").modal('show');
});

function toggleMenu() {
  var menu = document.getElementById('mobileMenu');
  var icon = document.getElementById('menuIcon');
  if (menu.style.display === 'none') {
      menu.style.display = 'flex';
      icon.classList.remove('fa-bars');
      icon.classList.add('fa-times');
  } else {
      menu.style.display = 'none';
      icon.classList.remove('fa-times');
      icon.classList.add('fa-bars');
  }
}

document.getElementById('reservationSelect').addEventListener('change', function() {
  var selectedValue = this.value;
  if (selectedValue) {
      window.location.href = selectedValue;
  }
});
