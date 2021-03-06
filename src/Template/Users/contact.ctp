<?= $this->element('header'); ?>
<?= $this->element('sidebar'); ?>
<?= $this->Html->script('contact'); ?>
<style>
.container-fluid {
    padding-left: 0;
    padding-right: 0;
}
</style>
<div class="container-fluid content contact">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Questions? message? Or just want to drop us a line? <br> This is the place.</h1>
            <form action="" id="contactForm" class="contact-form">
                <div class="row">
                    <div class="col-md-6">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="name">
                    </div>
                    <div class="col-md-6">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="email">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input type="submit" class="contactSubmit" id="comment-submit" value="Send">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>

// Set active tab
$('.contact-link').addClass('active');

</script>
