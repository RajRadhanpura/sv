<?php include('header.php'); ?>

<div class="section">
    <div class="horizontal-scroller hero">
        <div data-w-id="2797be1f-952f-d3cc-cf52-5041c8f40593" class="horizontal-scroll-track">
            <div class="horizontal-scroller-content">
                <div class="container">
                    <div class="scroller-track hero large">
                        <div class="anim-on-load-container">
                            <div style="opacity:1;display:block" class="animonload-right"></div>
                            <h1>Say hello, i’d love to say hi back</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <section id="contact-form" class="contact-form wf-section">
            <div class="w-container">
                <div class="w-form">
                    <form id="wf-form-Contact-Form" name="wf-form-Contact-Form" data-name="Contact Form"
                        method="get">
                        <div><input type="text" class="form-input large w-input" maxlength="256" name="Name"
                                data-name="Name" placeholder="Your Name" id="Name" required=""></div>
                        <div><input type="email" class="form-input large w-input" maxlength="256" name="Email"
                                data-name="Email" placeholder="Email" id="Email" required=""></div>
                        <div><input type="text" class="form-input large w-input" maxlength="256" name="Company"
                                data-name="Company" placeholder="Company" id="Company"></div>
                        <div><textarea data-name="Message" maxlength="5000" id="Message" name="Message"
                                placeholder="Message" class="form-input large w-input"></textarea></div>
                        <div class="right-text"><input type="submit" value="Send" data-wait="Please wait..."
                                class="submit-button large w-button"></div>
                    </form>
                    <div class="success-message w-form-done">
                        <div>Thank you! <br>Your submission has been received!</div>
                    </div>
                    <div class="error-message w-form-fail">
                        <div>Oops! Something went wrong while submitting the form.</div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?php include('footer.php'); ?>