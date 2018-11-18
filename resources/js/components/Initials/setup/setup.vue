<template>
    <div>


        <form action="/action_page.php">
            <div class="form-group">
                <label for="c_name">Company name</label>
                <input type="text" class="form-control" id="c_name" placeholder="Company Name">
            </div>
            <div class="form-group">
                <label for="l_key">License Key:</label>
                <input type="text" class="form-control" id="l_key">
            </div>

            <button type="submit" class="btn btn-default">Next</button>
        </form>
    </div>
</template>