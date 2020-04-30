<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Simple duplicate checker</title>
	<script src="cryptojs.js" type="text/javascript" charset="utf-8" defer></script>
	<style type="text/css" media="screen">
		*{
			box-sizing: border-box;
		}
		.mainBox{
			width: 300px;
			height: auto;
			margin:0 auto;
			border:1px solid blue;
			border-radius:5px;
			padding:30px;
		}
	</style>
</head>
<body>


	<div class="mainBox">
		<h3>Simple duplicate checker</h3>
		<label>File One :<input class="fone" type="file" name="fileOne" value=""></label>
		<p class="fileOneCheck"></p>
		<br>
		<label>File Two :<input class="ftwo" type="file" name="fileTwo" value=""></label>
		<p class="fileTwoCheck"></p>
		<br>
		<button class="check">Check</button>
		<button class="clear">Clear All</button>
		<p class="result"></p>
	<div>



		<script type="text/javascript">

			const ck_btn   = document.querySelector('.check');
			const cl_btn   = document.querySelector('.clear');
			const file_one = document.querySelector(".fone");
			const file_two = document.querySelector(".ftwo");
			const file_one_md5 = document.querySelector(".fileOneCheck");
			const file_two_md5 = document.querySelector(".fileTwoCheck");
			const result= document.querySelector('.result');

  			file_one.addEventListener('change',hell(file_one_md5),false);
  			file_two.addEventListener('change', hell(file_two_md5),false);
  			ck_btn.addEventListener('click',check,false);
  			cl_btn.addEventListener('click',clear_all,false);


  			function hell(para){
  				return function eventHandler(event){
				let file = event.target.files[0];
				//alert(`File name: ${file.name}`); // e.g my.png
			  	//alert(`Last modified: ${file.lastModified}`); // e.g 1552830408824
			  	
				fileHash(file,function(chk){
					    para.textContent =chk;
					});
				
				}
			}


  			function fileHash(file,callback) {

			  let reader = new FileReader();
			  reader.readAsBinaryString(file);
			  reader.onload = function(event) {
				  let binary = event.target.result;
				 // alert(binary);//binary data
				  let md5 = CryptoJS.MD5(binary).toString();
				 // alert(md5);// md5 value
				  callback(md5) ;
				  
			  };


			};
			



			function check(){
				//alert('check');
				let val1 = file_one_md5.textContent;
				let val2 = file_two_md5.textContent;

				if(val1.length == 0 || val2.length == 0){

					result.textContent="Select files";
					result.style.color="blue";
				}
				else{
		
				//let isEqual = val1.localeCompare(val2);
  				
	  			let isEqual = JSON.stringify(val1) === JSON.stringify(val2);
	  			//alert(isEqual);

	  				if(isEqual){
	  					result.textContent="Duplicate files";
	  					result.style.color="red";
	  				}
	  				else{
	  					result.textContent="Different files";
	  					result.style.color="green"; 	
	  				}
  				}


			};

			

			function clear_all () {
				//alert('clear');
				file_two.value='';
				file_one.value='';
				file_one_md5.textContent='';
				file_two_md5.textContent='';
				result.textContent='';


			};

			
		</script>

</body>
</html>