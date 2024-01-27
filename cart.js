function handleToggleItemClick() {
    window.location.href = "cart-new.php";
  }
  
  function redirectToIndex() {
    window.location.href = "index.php";
  }
  
  let cls = document.querySelector(".close");
  
  cls.addEventListener("click", function (e) {
    e.preventDefault();
    window.location.href = "index.php";
  });
  