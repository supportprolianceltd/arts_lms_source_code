<input type="hidden" name="lesson_type" value="text-description">

<div class="form-group">
    <label for="text_description"> <?php echo get_phrase('enter_your_text'); ?></label>
    <textarea name="text_description" class="form-control summer_note_ext_1 summer_note_ext_strip" id="text_description" rows="4"></textarea>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        //initSummerNote(['#text_description']);
        initSummerNoteExt($('#text_description'));
    });
</script>