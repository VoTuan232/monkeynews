<script type="text/javascript">

        $(document).ready(function() {

              $('span.add-quest').click(function() {
            var number_quest =   parseInt(document.getElementById("number-quest").value);
            // alert(number_quest);
                    if (number_quest <= -1) {
                        alert('Bạn phải nhập câu hỏi lớn hơn 0');
                    }
                    else {
                        // alert(number_quest);
                            for (i = 1; i <= number_quest; i++) {
                                $('div.question-form').append(`
                                    <div class="form-group">
                                        <label for="question" class="col-md-3 control-label">Question ` + i +`</label>
                                        <div class="col-md-12">
                                            <textarea class="editor" name="content" cols="120" id="content"></textarea>
                                        </div>
                                        <label for="answers" class="col-md-3 control-label">Answers</label>
                                        <div class="row-ml-1">
                                            <div class="col-md-3">
                                                <input class="browser-default custom-select" name="number-ans" type="number" id="number-ans-`+ i +`">
                                            </div>
                                            <div class="col-md-9 pt-2">
                                                <span class="text-success add-ans" data-id="`+i+`"><i class="fas fa-plus-circle"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ans-form-`+i+`">

                                    </div>
                                    <div class="form-group ml-3">
                                        <label for="explain">Explain</label>
                                        <div class="col-md-12">
                                            <textarea class="editor" name="explain" cols="120" id="explain"></textarea>
                                        </div>
                                    </div>
                                `);
                            }

                             $(".row-ml-1").on('click', 'span.add-ans', function(e) {
                                e.preventDefault();
                                 var ans_id = $(this).data('id');
            var ans_question =   parseInt(document.getElementById("number-ans-"+ans_id).value);

                                // alert(ans_id)
                                for (j = 0; j < ans_question; j++) {
                                    // alert('hihi');
                                        $('div.ans-form-'+ans_id).append(`
                                            <div class="form-group ml-3">
                                                <input type="checkbox" name="correct_ans[]" value="`+ j +`">
                                                <label>Answer `+j+`:</label>
                                                <input type="text" name="answer[]" class="form-control" value="">
                                            </div>
                                        `);
                                    }
                            });

            //                 $('span.add-ans-1').click(function() {
            // var number_ans =   parseInt(document.getElementById("number-ans-1").value);
            //                         for (j = 0; j < number_ans; j++) {
            //                             $('div.ans-form-1').append(`
            //                                 <div class="form-group ml-3">
            //                                     <input type="checkbox" name="correct_ans[]" value="`+ j +`">
            //                                     <label>Answer `+j+`:</label>
            //                                     <input type="text" name="answer[]" class="form-control" value="">
            //                                 </div>
            //                             `);
            //                         }
            //                 });

                    }
              })
        });
</script>