  $(
    function() {
       $('#videoFile').change(env=> {
           $(env.target).closest('form').trigger('submit');
       })
}
)();