function readURL(input) 
{
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgselectarea')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
                $('#imgselectarea').selectAreas({

        // editable
        allowEdit: true,

        // moveable

        allowMove: true,

        // resizable
        allowResize: true,

        // selectable
        allowSelect: true,

        // deletable
        allowDelete: true,

        // minimum size of a selection
        //minSize: [50, 50],

        // allows keyboard arrows for moving the selection
        allowNudge: true

    });
            }
}



