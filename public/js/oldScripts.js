function saveArea(){
               //select all selected areas by id
               var areas = document.querySelectorAll("[id^='area']");
               
               //duplicate and append the areas in the right panel
               for(var i = 0 ; i< areas.length ; i++)
               {
                   var itm =areas[i];
                   itm.setAttribute("id", "duplicate" + itm.id.charAt(4))
                   var cln = itm.cloneNode(true);
                   document.getElementById("rightPanel").appendChild(cln);
               }
               
           }
            
            // convert base64/URLEncoded data to Blob
            function dataURItoBlob(dataURI) {
                var byteString;
                if (dataURI.split(',')[0].indexOf('base64') >= 0)
                    byteString = atob(dataURI.split(',')[1]);
                else
                    byteString = unescape(dataURI.split(',')[1]);

                // separate out the mime component
                var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

                // write the bytes of the string to a typed array
                var ia = new Uint8Array(byteString.length);
                for (var i = 0; i < byteString.length; i++) {
                    ia[i] = byteString.charCodeAt(i);
                }

                return new Blob([ia], {type:mimeString});
            }
            //base64 uri
            var uri "";
            
            // Use createObjectURL to make a URL for the blob
            var image = new Image();
            image.src = URL.createObjectURL(dataURItoBlob(uri));
            //image.src = "https://image.ibb.co/inyN4f/chien-menu-1.png";
            document.getElementById("rightPanel").appendChild(image);
            