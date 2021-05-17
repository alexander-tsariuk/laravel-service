<div class="section_title text-center position-relative mb-66">
    <h2>Связаться <span>с нами</span></h2>
</div>
<div class="row" id="contact-row">
    <div class="col-12">
        <div class="footer_inner position-relative">
            <div class="footer_form">

                <!-- Contact Form -->
                <div class="contact-form">

                    <!--Contact Form-->
                    <form id="contact-form" method="POST" action="{{ route('ajax.contact.send') }}">
                        @csrf
                        <input type="hidden" name="lang" value="{{ app()->getLocale() }}"/>
                        <div class="row">
                            <div class="col-lg-6 col-md-8 col-sm-12 form_input_list">
                                <input name="name" placeholder="{{ __('front::contact-form.your_name', [], app()->getLocale()) }}" type="text" required>
                            </div>
                            <div class="col-lg-6 col-md-884484 col-sm-12 form_input_list">
                                <input name="phone" placeholder="{{ __('front::contact-form.your_phone', [], app()->getLocale()) }}" type="text" required>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form_input_list">
                                <textarea name="message" placeholder="{{ __('front::contact-form.your_message', [], app()->getLocale()) }}"></textarea>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                <button class="  btn btn-link" type="submit" name="submit-form"><span class="txt">{{ __('front::contact-form.send_contact', [], app()->getLocale()) }}</span></button>
                            </div>
                        </div>
                    </form>
                    <p class="form-messege"></p>
                    <!--End Contact Form -->
                </div>
            </div>
        </div>
    </div>
</div>
