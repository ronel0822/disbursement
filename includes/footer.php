  <!-- jQuery -->
  <script type="text/javascript" src="../js/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="../js/popper.min.js"></script>
  <!-- MDBootstrap Datatables  -->
  <script type="text/javascript" src="../js/addons/datatables.min.js"></script>

	<script type="text/javascript">


		$(document).ready(function () {
	      $('#dtVerticalScrollExample').DataTable({
	        "scrollY": "500px",
	        "scrollCollapse": true,
	      });
	      $('.dataTables_length').addClass('bs-select');
	    });

		$(document).ready(function() {
      		$("#notificationBtn").click(function() {

  			$("#notificationDrop").load("notificationDrop.php");
  			$("#notificationBadge").load("notificationClicked.php");

	    	});
	    });

	    function loadDoc() {
		  setInterval(function(){
		   var xhttp = new XMLHttpRequest();
		   xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
	    		document.getElementById("notificationBadge").innerHTML = this.responseText;
		    }
		   };
		   xhttp.open("GET", "notificationCount.php", true);
		   xhttp.send();

		  },1000);


		 }
		 loadDoc();

		 function notificationInsert() {
		  setInterval(function(){
		   var xhttp = new XMLHttpRequest();
		   xhttp.open("PU", "notificationInsert.php", true);
		   xhttp.send();

		  },1000);


		 }
		 notificationInsert();

	</script>

</body>
</html>