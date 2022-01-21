

function productInTrash(id){
	
	var query = "?product=" + id;
	var resourcePath = "include/trash.php";
	var uri = resourcePath + query;
	
	var xhr = new XMLHttpRequest();
		
		xhr.open("GET", uri, true);
		
		xhr.onreadystatechange = function() {
			//console.log("Ready state: " + xhr.readyState);
			
			if(xhr.readyState == 4 && xhr.status == 200) {
				
				var res = xhr.responseText;
				var a = document.getElementById("trash-menu-txt");
				
				a.innerHTML = "Корзина - " + res + " товар";
				
			}
		}
		xhr.send();
}