<?php include("top.html"); ?>
<div>
    <form id="frmsignup" method="post" action="signup-submit.php">
        <fieldset>
        <legend>New User Signup:</legend>
            <p>
            <label><strong>Name:</strong></label>
            <span class="column">
                <input type ="text" name = "name" size="16" />
            </span>
            </p>
            <br>
            <p>
            <label><strong>Password:</strong></label>
            <span class="column">
                <input type ="password" name = "password" size="16" />
            </span>
            </p>
            <br>
            <p>            
            <label><strong>Gender:</strong></label>
            <span class="column">
            <input type ="radio" name="gender" value="F"/> Female
                <input type ="radio" name="gender" value="M"/> Male
            </span>
            </p>
            <br>
            <p>                        
            <label><strong>Age:</strong></label>
            <span class="column">
                <input name="age" type="text" size="6" maxlength="2">
            </span>
            </p>
            <br>
            <p>            
            <label><strong>Personality Type:</strong></label>
            <span class="column ptype">
                <input name="ptype" type="text" size="6" maxlength="4">           
            </span>
             <a href="http://www.humanmetrics.com/cgi-win/JTypes2.asp" target="blank">(Don't know your type?)</a>
            </p>            
            <p>            
            <label><strong>Favorite OS:</strong></label>
            <span class="column">
                <select name="favos">
                        <option value="Windows">Windows</option>
                        <option value="Mac OS X">Mac OS X</option>
                        <option value="Linux">Linux</option>
                </select>
            </span>
            </p>
            <br>
            <p>            
            <label><strong>Seeking Age:</strong></label>
            <span class="column">
                <input type="text" name="min" placeholder="min" size="4" maxlength="2"> 
                    to 
                <input type="text" name="max" placeholder="max" size="4" maxlength="2">
            </span>
            </p>
            <br>
            <p>
                <input type="submit" value="Sign Up">
            </p>
        </fieldset>
    </form>
</div>

<?php include("bottom.html"); ?>