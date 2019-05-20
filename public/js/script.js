// SideNav Button Initialization
$(".button-collapse").sideNav();

// SideNav Scrollbar Initialization
var sideNavScrollbar = document.querySelector('.custom-scrollbar');
Ps.initialize(sideNavScrollbar);
//

function incrementTries(e){

  //console.log(e.parentNode.parentNode.id);
  $.ajax({
    url: "/question_answer/try",
    method: 'POST',
    data:{id_row : parseInt(e.parentNode.parentNode.id), id_tag : e.id }
  })
  .done(function(result){
    console.log(result);

    var number = e.childNodes[0];
    number.innerHTML = parseInt(result);
  })
  .fail(function(err) {
    console.log(err)
  });
}

//wysiwig
function edit() {
  $('.click2edit').summernote({focus: true});
};

function save() {
  var markup = $('.click2edit').summernote('code');
  $('.click2edit').summernote('destroy');
};

function setFormField(field){
  console.log(field);
  (field == 'question') ?  $('#question_answer_question').val($('.click2edit').html()) : $('#question_answer_answer').val($('.click2edit').html());
}

function getFormField(field){
  (field == 'question') ?  $('.click2edit').html($('#question_answer_question').val()) : $('.click2edit').html($('#question_answer_answer').val())
}

//blur answer onclick toggler
$(".answer-col").click(function(event){
  $( event.target ).closest(".answer-col").toggleClass("blurred");
  //var parent = $( event.target ).parentNode;
  //console.log(parent);

});
