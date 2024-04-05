class garden {

    selectUnits() {

        var cde = document.getElementById('area_units').value; 
        var codeAction = "apply_area_units";
        $.get("../controller/ajax.php", {"code_action":codeAction,"units":cde}, this.reload);

    }

    selectDepthUnits() {

        var cde = document.getElementById('depth_units').value; 
        var codeAction = "apply_depth_units";
        $.get("../controller/ajax.php", {"code_action":codeAction,"units":cde}, this.reload);

    }

    addToBasket() {

        var codeAction = "add_to_basket";
        $.get("../controller/ajax.php", {"code_action":codeAction}, this.reload);

    }

    clearBasket() {

        var codeAction = "clear_basket";
        $.get("../controller/ajax.php", {"code_action":codeAction}, this.reload);

    }

    reload(response) {
        
        // alert(response);
        document.location.reload();

    }

}

gc = new garden();
