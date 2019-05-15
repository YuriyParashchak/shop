// $('#sendMessage').on('click',function (e) {
//     e.preventDefault();
//     $("#modalCard").modal("show");
//     var idMessage = $(this).data('message-id');
//
//   $.ajax({
//         method:'POST',
//         url: 'send-message',
//         data: {idMessage:idMessage },
//         success: function (data) {
//             console.log(data);
//             $('.modal-body').html(data);
//
//         },
//         error: function () {
//             console.log('form error');
//         }
//
//     })
// });
