@section('js')
  <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>
  tinymce.init({
    selector:'{{ Request::is('create') ? '#topicBody' : 'textarea' }}',
    height: 300,
    theme: 'modern',
    plugins: [
      'advlist autolink lists link image charmap print preview hr anchor pagebreak',
      'searchreplace wordcount visualblocks visualchars code',
      'insertdatetime media nonbreaking save table contextmenu directionality',
      'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
    ],
    toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | forecolor backcolor emoticons | codesample',
    image_advtab: true,
  });
  </script>
@endsection
