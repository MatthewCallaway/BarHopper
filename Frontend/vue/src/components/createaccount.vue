
<template>
<div id="main-page">
	<div class="createBox">
        <h1>Create An Account</h1>
			<p>First Name</p>
			<input v-model ="firstName" type="text" name="fName" placeholder="Enter First Name">
			<p>Last Name</p>
			<input v-model ="lastName" type="text" name="lName" placeholder="Enter Last Name">
			<p>Email</p>
			<input v-model ="email" type="email" name="eMail" placeholder="Enter Your Email">
			<div class="dropdown">
			<!--<button class="dropbtn">Gender</button>
			<div id="myDropdown" class="dropdown-content">
				<a href="#">Male</a>
				<a href="#">Female</a>
				</div>-->
			<b-dropdown id="ddown1" text="Dropdown Button" class="m-md-2">
			    <b-dropdown-item>Male</b-dropdown-item>
			    <b-dropdown-item>Female</b-dropdown-item>
			 </b-dropdown>
			</div>
            <p>Username</p>
            <input v-model ="username" type="text" name="" placeholder="Enter Username">
            <p>Password</p>
            <input v-model ="pass" type="password" name="" placeholder="Enter Password">
            <input @click="registerUser()" type="submit" name="" value="Create Account">
            <a href="#">Lost your password?</a><br>
    </div>
</div>
</template>



<script>
	export default{
		data(){
			return{
				firstName: '',
				lastName: '',
				email: '',
				username: '',
				pass: '',
			}
		},
		methods:{
			registerUser(){
				var postData = {
					firstName: this.firstName,
					lastName: this.lastName,
					email: this.email,
					pass: this.pass,
					username: this.username
				}


				this.$http.post('http://127.0.0.1:8000/api/registerUser', postData).then(response=>{
					console.log(response.data)
				})
			},	
			
		}
	}

</script>





<style>
	body{
	    margin: 0;
	    padding: 0;
	    background-size: cover;
	    background-position: center;
	    font-family: sans-serif;
	}

	.createBox{
	    width: 320px;
	    height: 650px;
	    background: #000;
	    color: #ffc107;
	    top: 50%;
	    left: 50%;
	    position: absolute;
	    transform: translate(-50%,-50%);
	    box-sizing: border-box;
	    padding: 70px 30px;
	}

	h1{
	    margin: 0;
	    padding: 0 0 20px;
	    text-align: center;
	    font-size: 22px;
	}

	.createBox p{
	    margin: 0;
	    padding: 0;
	    font-weight: bold;
	}

	.createBox input{
	    width: 100%;
	    margin-bottom: 20px;
	}

	.createBox input[type="text"], input[type="password"], input[type="email"]
	{
	    border: none;
	    border-bottom: 1px solid #fff;
	    background: transparent;
	    outline: none;
	    height: 40px;
	    color: #fff;
	    font-size: 16px;
	}
	.createBox input[type="submit"]
	{
	    border: none;
	    outline: none;
	    height: 40px;
	    background: #ffc107;
	    color: #000;
	    font-size: 18px;
	    border-radius: 20px;
	}
	.createBox input[type="submit"]:hover
	{
	    cursor: pointer;
	    background: #ffc107;
	    color: #000;
	}
	.createBox a{
	    text-decoration: none;
	    font-size: 12px;
	    line-height: 20px;
	    color: darkgrey;
	}

	.CreateBox a:hover
	{
	    color: #ffc107;
	}

	.dropbtn{
		background-color: #ffc107;
	    color: white;
	    padding: 2%;
	    font-size: 100%;
	    border: none;
	    cursor: pointer;
	}

	.dropdown-content {
	    display: none;
	    position: absolute;
	    background-color: #f1f1f1;
	    min-width: 160px;
	    overflow: auto;
	    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	    z-index: 1;
	}

	.dropdown-content a {
	    color: black;
	    padding: 12px 16px;
	    text-decoration: none;
	    display: block;
	}

	.show {display:block;}


</style>
