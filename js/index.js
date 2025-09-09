
$(document).ready(function(){

    // change navbar color when window scrolls
    var myNav = $(".navbar");
    $(window).on('scroll', function() {
        "use strict";
        if ($(window).scrollTop() >= 180) {
            myNav.addClass("active");
        } else {
            myNav.removeClass("active");
        };
    });

    bodyDiv = [];
    // $(document).find("body").children().each(function (index, elem) {
    //     if (elem.id != "") {
    //         bodyDiv.push(elem.id);
    //         console.log(elem.id);
    //         $(`.${elem.id}`).on("click", function() {
    //             $(`#${elem.id}`).scroll()
    //         })
    //     }
    // });
    // console.log(bodyDiv)
    // bodyDiv

// hide navbar collapse when nav item is clicked.
$('.navbar>div>a').on('click', function() {
    $('.navbar-collapse').collapse('hide');
});

// read more / read less button
    $(".readMoreText").hide();
    $(".read-or-hide").on("click", function () {
        var txt = $(".readMoreText").is(':visible') ? 'Read More' : 'Read Less';
        $(this).text(txt);
        $(this).parent().children(".readMoreText").fadeToggle(200);
        $(this).parent().children(".fixedText").children(".ellipsis").fadeToggle(200);
        // if($(this).parent().children(".readMoreText").is(':visible')) {
        //     $(this).parent().children(".fixedText").children(".ellipsis").hide();
        // } else {
        //     $(this).parent().children(".fixedText").children(".ellipsis").show();
        // }
    });

    // $(".emailFeedback").

    $("#submitForm").on("click", function() {
        console.log("submitForm")
        let $name = $("#InputName").val();
        let $email = $("#InputEmail").val();
        let $cellNo = $("#InputCellNo").val();
        let $message = $("#messageArea").val();
        $(this).data({"name": $name, "email": $email, "cellNo": $cellNo, "message": $message})
        submitForm($name, $email, $cellNo, $message);
    })
    
    // Shop btn
//     $(".shopBtn").on("click", function() {
//         console.log("Clicked")
//         // $.ajax(settings).done(function (response) {
// //   console.log(response);
// // });
//         doAjaxPromise("https://www.juanamlima.co.za/checkout.php")
//         .then(function(data) {
//             console.log(data)
//         })
//         .catch(function(err) {
//             console.log(err)
//         })
//     })


});


function submitForm($name, $email, $cellNo, $message) {
    $name = $name ? $name : undefined;
    $email = $email ? $email : undefined;
    $cellNo = $cellNo ? $cellNo : undefined;
    $message = $message ? $message : undefined;
    doAjaxPromise(`http://www.juanamlima.co.za/postEmail.php`, {name: $name, email: $email,  cellNo: $cellNo, message: $message})
    .then(function(res) {
        if (res.status == "Success") {
            $(".contactFormMsgFailed").html(res.message).css({"background-color": "#2EE59D"}).animate({opacity: 1}, "slow");
            setTimeout(function(){
                $(".contactFormMsgFailed").animate({opacity: 0}, "slow");
            }, 7000)
        } else {
            $(".contactFormMsgFailed").html(res.message).animate({opacity: 1}, "slow");
            setTimeout(function(){
                $(".contactFormMsgFailed").animate({opacity: 0}, "slow");
            }, 7000)
        }
    }).catch(function (error) {
        console.log(error);
    })
}

   // Ajax Promise function
   function doAjaxPromise(url, data, headers) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: url,
            headers: headers,
            type: "POST",
            data: data,
            dataType: 'json',
            crossDomain: true,
            cache: false,
            timeout: 30000,
            success: function (data) {
                resolve(data);
            },
            error: function (error) {
                reject(error);
            },
        });
    });
};

