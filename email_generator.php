<?php

 get_header();
?>
<style>
    .d-none{
        display: none;
    }
    .container {
    max-width: 1280px;
    width: 100%;
    margin: auto;
    }
	.container h2{
		margin: 50px 0 30px;
	}
    .container label {
    display: block;
    font-weight: bold;
    margin-bottom: 6px;
    }
    .container .form-group {
    margin-bottom: 20px;
    }
    .container .form-group input, .container .form-group select, .container .form-group textarea {
    margin: 0;
    padding: 10px;
    outline: none;
    border: 1px solid #e5dfdf;
    background-color: #f7f7f7;
    width: -webkit-fill-available;
    }
    .container .form-group-radio {
    margin-bottom: 20px;
    }
    .container .form-group-radio input {
    margin-right: 4px;
    }
    .container #preview {
    background-color: #7d252b;
    border: none;
    outline: none;
    color: white;
    padding: 8px 15px;
    border-radius: 3px;
    cursor: pointer;
	line-height: normal;
    }
	#email_Generator_Form select{
		background-position-y: 50%;
	}
	tr, td, table{
		border: none;
		width: inherit;
		padding: 0;
	}
	table{
		    display: table;
    border-collapse: separate;
    box-sizing: border-box;
    text-indent: initial;
    white-space: normal;
    line-height: normal;
    font-weight: normal;
    font-size: medium;
    font-style: normal;
    color: -internal-quirk-inherit;
    text-align: start;
    border-spacing: 2px;
    border-color: gray;
    font-variant: normal;
	}
	table img{
		height: 50px;
	}
</style>
<div class="container" id="email_Generator_Form">
    <h2>Email Signature Generator</h2>
    <form role="form" method="post" target="preview" id="form">
    <div class="form-group">
        <label for="select_style">Select The Style</label>
        <select id="select_style" name="Sender[variation]" default="simple" onChange="profileOption(value)" >
            <option value="left">With Profile Image</option>
            <option value="simple" selected>Without Profile Image</option>
        </select>
    </div>
    <div class="form-group">
        <label for="Name">Name</label>
        <input type="text" class="form-control" id="Name" name="Sender[name]" placeholder="Enter your name">
    </div>
    <div class="form-group profile_image d-none" >
        <label for="yourImg">Your Image: .jpg or .png (optional)</label>
        <input type="file" accept="image/*" id="yourImg" name="Sender[yourImg]">
    </div>
    <div class="form-group">
        <label for="Broker">Title?</label>
		 <input type="text" class="form-control" id="Broker" name="Sender[broker]" placeholder="Enter the tiltle here...">
    </div>
    <div class="form-group-radio">
        <label for="Realtor">REALTOR®?</label>
        <input type="radio" name="Sender[realtor]" value="yes">Yes
        <input type="radio" name="Sender[realtor]" value="no">No
    </div>
    <div class="form-group">
        <label for="Designations">Designations (optional)</label>
        <input type="text" class="form-control" id="Designation" name="Sender[designations]" placeholder="For example: CRS, CNE, ETC">
    </div>
    <div class="form-group">
            <label for="Phone">Cell Phone Number</label>
            <input type="phone" class="form-control" id="Phone" name="Sender[phone]" placeholder="10 digits including area code">
    </div>
    <div class="form-group">
        <label for="Web">Agent Webpage URL (optional)</label>
        <input type="text" class="form-control" id="Web" name="Sender[web]" placeholder="Enter your webpage URL">
    </div>
    <div class="form-group">
        <label for="Award1">Award 1 (optional)</label>
        <input type="text" class="form-control" id="Award1" name="Sender[award1]" placeholder="Enter first award here or leave blank">
    </div>
    <div class="form-group">
        <label for="Award2">Award 2 (optional)</label>
        <input type="text" class="form-control" id="Award2" name="Sender[award2]" placeholder="Enter second award here or leave blank">
    </div>
    <div class="form-group">
        <label for="Award3">Award 3 (optional)</label>
        <input type="text" class="form-control" id="Award3" name="Sender[award3]" placeholder="Enter third award here or leave blank">
    </div>
    <div class="form-group">
        <label for="Video">Agent Video (optional). Text displayed in signature will read: “Watch my video to learn more.”</label>
        <input type="text" class="form-control" id="Video" name="Sender[video]" placeholder="Paste your Agent Video URL here or leave blank">
    </div>                  
    <div class="form-group">
        <label for="Facebook">Facebook (optional)</label>
        <input type="text" class="form-control" id="Facebook" name="Sender[facebook]" placeholder="Copy and paste your Facebook URL">
    </div>
    <div class="form-group">
        <label for="Instagram">Instagram (optional)</label>
        <input type="text" class="form-control" id="Instagram" name="Sender[instagram]" placeholder="Enter your Instagram Handle">
    </div>
    <div class="form-group">
        <label for="Linkedin">LinkedIn (optional)</label>
        <input type="text" class="form-control" id="Linkedin" name="Sender[linkedin]" placeholder="Copy and paste your LinkedIn URL">
    </div>
    <div class="form-group">
        <label for="Pinterest">Pinterest (optional)</label>
        <input type="text" class="form-control" id="Pinterest" name="Sender[pinterest]" placeholder="Enter your Pinterest Handle">
    </div>
    <button id="preview" type="submit" class="btn btn-success">Preview</button>
    </form>
</div>
<div class="container" style="margin-top: 60px;" >
    <div id="generating_file">
    </div>
</div>
<?php
 get_footer();