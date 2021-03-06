/**
 *
 * @author: daxingplay<daxingplay@gmail.com>
 * @time: 12-12-24 17:00
 * @description:
 */

(function($){

    $('#J_PVUnitDropDown').on('click', 'a', function(ev){
        ev.preventDefault();
        $('#J_PVUnitInput').val(parseInt($(this).attr('data-value'), 10));
        $('#J_PVUnitShow').html($(this).text());
    });

    var showResultBtn = $('#J_ShowFullResult'),
        hideResultBtn = $('#J_HideFullResult'),
        fullResult = $('#J_FullResult');
    showResultBtn.on('click', function(ev){
        ev.preventDefault();
        showResultBtn.hide();
        hideResultBtn.show();
        fullResult.fadeIn();
    });

    hideResultBtn.on('click', function(ev){
        ev.preventDefault();
        hideResultBtn.hide();
        showResultBtn.show();
        fullResult.fadeOut();
    });

    var savedMoney = $('#J_ResultGuess').attr('data-num');
    if(savedMoney){

        var ladder = {};

        function generateLine(msg){
            return '<p>' + msg + '</p>';
        }

        function moneyDataShow(money){
            var html = '';
            if(savedMoney < 100){
                html += generateLine('您省的太少了，我懒得说了');
                return html;
            }
            if(savedMoney < 1000){
                html += generateLine('您省了' + parseInt(savedMoney, 10) + '张大团结');
            }
        }


    }

})(jQuery);