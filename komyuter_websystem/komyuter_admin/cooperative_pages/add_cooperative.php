<div class="add-cooperative-section">

<div class="cooperative-header-text-container">
    <h2 class="raleway-light">Add new cooperative</h2>
</div>

<form class="add-cooperative-form" method="POST" action="processes_actions/cooperative_actions.php?action=new">

    <div class="add-cooperative-form-container">

        <div class="cooperative-form-section">
            

            <label class="select-label">Cooperative Name</label> </br>
            <input type="text" name="coopname" placeholder="Cooperative name">

            <label>City</label> </br>
            <input type="text" name="city" placeholder="Residing City">


        </div>

        <div class="cooperative-form-section">
            <label>Address</label> </br>
            <textarea name="address" rows="4" placeholder="Enter cooperative's full address"></textarea>

        </div>

    </div>

    <hr class="nav-divider-1">
    
    <button type="submit" class="create-cooperative-button">ADD NEW COOPERATIVE</button>
    <button type="reset" class="create-cooperative-button">CLEAR</button>

</form>

 
</div>