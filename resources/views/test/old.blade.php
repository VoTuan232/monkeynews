<script type="text/javascript">
        $(document).ready(function() {
            $('input#number-quest').change(function() {
                var number_ans = {};
                var number_quest = $('input#number-quest').val();
                if (number_quest <= -1) {
                    alert('Bạn phải nhập câu hỏi lớn hơn 0');
                } else {
                    $('span.add-quest').click(function() {
                        // alert(number_quest);
                        if (number_quest != null) {

                            for (i = 1; i <= number_quest; i++) {
                                $('div.question-form').append(`
                                    <div class="form-group">
                                        <label for="question" class="col-md-3 control-label">Question ` + i +`</label>
                                        <div class="col-md-12">
                                            <textarea class="editor" name="content" cols="120" id="content"></textarea>
                                        </div>
                                        <label for="answers" class="col-md-3 control-label">Answers</label>
                                        <div class="row ml-1">
                                            <div class="col-md-3">
                                                <input class="browser-default custom-select" name="number-ans" type="number" id="number-ans-`+ i +`">
                                            </div>
                                            <div class="col-md-9 pt-2">
                                                <span class="text-success add-ans-`+ i +`"><i class="fas fa-plus-circle"></i></span>
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
                               var number_ans = $('#number-ans-1').val();
                               console.log(number_ans);
                                // number_ans[i] = $('#number-ans-'+i).val();
                                $('span.add-ans-1').click(function() {
                                    // alert(number_ans);
                                // $('span.add-ans-'+i).click(function() {
                                    alert($('#number-ans-1').val());
                                    // alert(number_ans[i]);
                                    for (j = 0; j < number_ans; j++) {
                                        alert('hiiihi')
                                        $('div.ans-form-1').append(`
                                            <div class="form-group ml-3">
                                                <input type="checkbox" name="correct_ans[]" value="`+ j +`">
                                                <label>Answer `+j+`:</label>
                                                <input type="text" name="answer[]" class="form-control" value="">
                                            </div>
                                        `);
                                    }
                                });
                        } 

                        else {
                            alert('Vui lòng nhập số câu hỏi');
                        }
                    });
                }
            });
        });
    </script>