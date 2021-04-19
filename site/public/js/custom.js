// Owl Carousel Start.................
$(document).ready(function() {
    var one = $("#one");
    var two = $("#two");

    $('#customNextBtn').click(function() {
        one.trigger('next.owl.carousel');
    })
    $('#customPrevBtn').click(function() {
        one.trigger('prev.owl.carousel');
    })
    one.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });

    two.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

});
// Owl Carousel End..................

//Contact Send

$('#contactSendBtnId').click(function (){
  var contactName= $('#contactNameId').val();
  var contactMobile= $('#contactMobileId').val();
  var contactEmail= $('#contactEmailId').val();
  var contactMsg= $('#contactMsgId').val();

  SendContact(contactName,contactMobile,contactEmail,contactMsg);

});


function SendContact(contact_name,contact_mobile,contact_email,contact_msg){

    if(contact_name.length==0){
        $('#contactSendBtnId').html('Enter your Name');
        setTimeout(function () {
            $('#contactSendBtnId').html('Submit');
        },2000)

    } else if(contact_mobile.length==0){
        $('#contactSendBtnId').html('Enter your Mobile No');
        setTimeout(function () {
            $('#contactSendBtnId').html('Submit');
        },2000)

    } else if(contact_email.length==0){
        $('#contactSendBtnId').html('Enter your Valid Email');
        setTimeout(function () {
            $('#contactSendBtnId').html('Submit');
        },2000)
        
    }else if(contact_msg.length==0){
        $('#contactSendBtnId').html('Enter your Massages');
        setTimeout(function () {
            $('#contactSendBtnId').html('Submit');
        },2000)
        
    } else{
        $('#contactSendBtnId').html('Request Processing');

        axios.post('/contact',{
            contact_name:contact_name,
            contact_mobile:contact_mobile,
            contact_email:contact_email,
            contact_msg:contact_msg,
    
        })
        .then(function (response){
            if(response.status == 200){
                if(response.data==1){
                    $('#contactSendBtnId').html('Request success');
                    setTimeout(function () {
                        $('#contactSendBtnId').html('Submit');
                    },2000)
    
    
                }else{
                    $('#contactSendBtnId').html('Request Failed! Please try again');
                    setTimeout(function () {
                        $('#contactSendBtnId').html('Submit');
                    },2000)
    
                }
    
            }else{
                $('#contactSendBtnId').html('Request Failed! Try again');
                setTimeout(function () {
                    $('#contactSendBtnId').html('Submit');
                },2000)
    
            }
    
    
        }).catch(function (){
            $('#contactSendBtnId').html('Please Try Again');
            setTimeout(function () {
                $('#contactSendBtnId').html('Submit');
            },2000)
    
        })
    
    }

}