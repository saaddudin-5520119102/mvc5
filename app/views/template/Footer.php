<?php if(isset($_SESSION["login"])):?>
	<script>
	document.addEventListener("DOMContentLoaded", () => {
	  const profNav = document.querySelector(".profNav");
	  const menu = document.querySelector(".profileMenu");

	  // Toggle active class on click
	  profNav.addEventListener("click", (e) => {
	    e.stopPropagation(); // prevent click from reaching document
	    profNav.classList.toggle("active");
	  });

	  // Hide menu when clicking outside
	  document.addEventListener("click", (e) => {
	    if (!profNav.contains(e.target)) {
	      profNav.classList.remove("active");
	    }
	  });
	});
		
	  // const profNav = document.querySelector("#profNav");
	  // const menu = document.querySelector(".profileMenu");

	  // // Toggle active class on click
	  // profNav.addEventListener("click", (e) => {
	  //   e.stopPropagation(); // prevent click from reaching document
	  //   profNav.classList.toggle("active");
	  // });

	  // // Hide menu when clicking outside
	  // document.addEventListener("click", (e) => {
	  //   if (!profNav.contains(e.target)) {
	  //     profNav.classList.remove("active");
	  //   }
	  // });
	</script>

<?php endif;?>
</body>
</html>