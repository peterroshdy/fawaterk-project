function show_block_two() {
            
            var block_one = document.getElementById("block-one");
            var name = document.getElementById("vendor_name").value;
            var email = document.getElementById("vendor_email").value;
            var password = document.getElementById("vendor_password").value;

            var block_two = document.getElementById("block-two");
            
            if (name && email && password) {

                block_one.style.display = "none";
                block_two.style.display = "block";
                
            }    
            
        }

        function show_block_three() {
            
            var block_two = document.getElementById("block-two");
            var address = document.getElementById("vendor_address").value;
            var national_id = document.getElementById("vendor_national_id").value;
            var phone = document.getElementById("vendor_phone").value;

            var block_three = document.getElementById("block-three");
            
            if (address && national_id && phone) {

                block_two.style.display = "none";
                block_three.style.display = "block";

            } 

            
        }

        