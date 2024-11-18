<div class="add-user-section">

<div class="user-header-text-container">
    <h2 class="raleway-light">Add new user</h2>
</div>

<form class="add-user-form" method="POST" action="processes_actions/user_actions.php?action=new">

    <div class="add-user-form-container">

        <div class="user-form-section">

            <label>First Name</label> </br>
            <input type="text" name="fname" placeholder="First name">

            <label>Last Name</label> </br>
            <input type="text" name="lname" placeholder="Last name">

            <label>Email</label> </br>
            <input type="text" name="email" placeholder="Email">

            <label>Password</label> </br>
            <input type="password" name="password" placeholder="Password">

            <label>Confirm Password</label> </br>
            <input type="password" name="confpassword" placeholder="Confirm password">

        </div>

        <div class="user-form-section">

            <label>Contact Number</label> </br>
            <input type="text" name="contactno" placeholder="Contact No.">

            <label>City</label> </br>
            <input type="text" name="city" placeholder="City">

            <label>Address</label> </br>
            <textarea name="address" rows="4" placeholder="Enter full address"></textarea>


            <div class="select-options-container"> 

                <div class="select-options-section"> 

                    <label class="select-label">User Level</label> </br>
                    <select class="user-level-options" name="access">
                        <option>Select Access</option>
                        <option value="0">Staff</option>
                        <option value="1">Manager</option>
                        <option value="2">Administrator</option>
                    </select>

                </div>

                <div class="select-options-section"> 

                    <label class="select-label">Status</label> </br>
                    <select class="user-level-options" name="status">
                        <option>Select Status</option>
                        <option value="0">Active</option>
                        <option value="1">Deactivated</option>
                        <option value="2">Terminated</option>
                    </select>

                </div>
        
            </div>

        </div>

    </div>

    <hr class="nav-divider-1">
    
    <button type="submit" class="create-user-button">CREATE NEW USER</button>
    <button type="reset" class="create-user-button">CLEAR</button>

</form>

 
</div>