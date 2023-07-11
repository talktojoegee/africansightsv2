@extends('layouts.homepage-layout')

@section('title')
    Privacy Policy
@endsection

@section('main-content')
    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Privacy Policy</h2>
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="{{route('homepage')}}">Home</a></li>
                            <li>Privacy Policy</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Headline -->
                <h2 class="headline with-border margin-top-45 margin-bottom-25">Who we are</h2>

                <p>
                    AfricanSights, found at <a href="{{route('homepage')}}">https://africansights.com/ (“Website”)</a>, is governed by the following privacy policy (“Privacy Policy”).
                    We respect your privacy and are committed to protecting it.
                    The purpose of this Privacy Policy is to describe what personally identifiable information we may collect and how it may be used. This statement only applies to this Website.
                </p>
                <h3 >What personal data do we collect, and why do we collect it
                    </h3>
                <h4>Cookies</h4>
                <p>We may log information using cookies, which are small data files stored on your browser by the Website. We may use both session cookies, which expire when you close your browser, and persistent cookies, which stay on your browser until deleted, to provide you with a more personalised experience on the Website.
                    If you leave a comment on our Website, you may opt-in to saving your name, email address and website in cookies. These are for your convenience so that you do not have to fill in your details again when you leave another comment. These cookies will last for one year.
                    The Website uses cookies to store visitors’ preferences, record user-specific information on what pages users access or visit, ensure that visitors are not repeatedly sent the same banner ads, and customise Website content based on visitors’ browser type or other information that the visitor sends.
                    Cookies may also be used by third-party services, such as Google Analytics, as described before.</p>
                <p>
                    Users may, at any time, prevent the setting of cookies, by the Website, by using a corresponding setting of your internet browser and may thus permanently deny the setting of cookies. Furthermore, already set cookies may
                    be deleted anytime via an Internet browser or other software programs. This is possible in all popular Internet browsers. However, if users deactivate the setting of cookies in your Internet browser, not all functions of our Website may be entirely usable.
                </p>
                <h4>Comments</h4>
                <p>
                    When visitors leave comments on the Website, we collect the data shown in the comments form (such as your name or email address), and also the visitor’s IP address, operating system type, referring website, pages you viewed, the dates or times when you accessed the Website and browser user agent string to help spam detection. We may also collect information about actions you take when using the Website, such as links clicked. Your information has been anonymised and only viewed aggregately.
                    An anonymised string created from your email address (also called a hash) may be provided to the Gravatar service to see if you are using it.
                    The Gravatar service privacy policy is available here: https://automattic.com/privacy/. After approval of your comment, your profile picture is visible to the public in the context of your comment.
                </p>
                <h4>Sensitive personal information</h4>
                <p>
                    If you leave a comment, certain information (your name as you provide it) may be publicly visible, however, your address will not be. We will not contact you using your email as it goes against GDPR regulations. So if you wish to be contacted by Culture Tourist,
                    please contact us directly (through the contact form).
                    At no time should you submit sensitive personal information to the website. This includes your social security number, information regarding race or ethnic origin, political opinions, religious beliefs, health information, criminal background, or trade union memberships.
                    If you elect to submit such information to us, it will be subject to this Privacy Policy.
                </p>
                <h4>Media</h4>
                <p>If you upload images to the website, you should avoid uploading images with embedded location data (EXIF GPS) included. Visitors to the website can download and extract any location data from images on the website.</p>
                <h4>Children’s information</h4>
                <p>This Website does not knowingly collect any personally identifiable information from children under the age of 16. If a parent or guardian believes that the Website has personally identifiable information of a child under the age of 16 in its database, please contact us immediately. We will use our best efforts to remove such information from our records promptly.</p>
                <h4>Embedded content from other websites</h4>
                <p>Articles on this site may include embedded content (e.g. videos, images, articles, etc.). Embedded content from other websites behaves in the exact same way as if the visitor has visited the other website.
                    These websites may collect data about you, use cookies, embed additional third-party tracking, and monitor your interaction with that embedded content, including tracking your interaction with the embedded content if you have an account and are logged in to that website.</p>
                <h4>Advertising</h4>
                <p>This Website is affiliated with Google Adsense for the purposes of placing advertising on the Website.</p>
                <h4>Affiliate links</h4>
                <p>AfricanSights has financial relationships with some of the merchants mentioned on this blog. AfricanSights may be compensated if consumers choose to utilise the links located throughout the content on this site and generate sales for the said merchant. You are not obligated to click on any links or buy any advertised products.</p>
                <h4>GDPR Compliance</h4>
                <h4>Who we share your data with</h4>
                <p>At AfricanSights, we take data safety seriously, and use your private data only to offer a personalised experience. We use cookies to track analytics as well as to personalise ads. Cookie data is shared with our advertising company, Google Adsense.</p>
                <ul>
                    <li>We use Mailchimp for our newsletter, which you can opt out of, and Google Analytics for analysing website data.</li>
                    <li>If you subscribed to our newsletter, you will receive our newsletters. You can always unsubscribe by following the link in email or by emailing us.</li>
                    <li>If you give us your name, it will only be used to personalise the newsletters.</li>
                    <li>We have never sold, we are not selling, and we will not sell any of your personal data provided to us.</li>
                    <li>All of our affiliates are GDPR compliant.</li>
                </ul>
                <h4>Third-party use of personal information</h4>
                <p>We may share your information with third parties when you explicitly authorise us to share your information. Additionally, the Website may use third-party service providers to service various aspects of the Website. Their respective privacy policies dictate each third-party service provider’s use of your personal information.</p>
                <p>AfricanSights, currently uses the following third-party service providers:</p>
                <p>Google Analytics – this service tracks Website usage and provides information such as referring websites and user actions on the Website. Google Analytics may capture your IP address, but Google Analytics captures no other personal information.
                    MailChimp – this service is used to deliver email updates and newsletters. We store your name and email address for purposes of delivering such communications. Please, refer to MailChimp’s privacy policy for further information.</p>
                <h4>How long do we retain your data</h4>
                <p>If you leave a comment, the comment and its metadata are retained indefinitely. This is so we can recognise and approve any follow-up comments automatically instead of holding them in a moderation queue.</p>
                <h4>What rights do you have over your data</h4>
                <p>If you have an account on this site or have left comments, you can request to receive an exported file of the personal data we hold about you, including any data you have provided to us. You can also request that we change or erase any personal data we hold about you. This does not include any data we are obliged to keep for administrative,
                    legal, or security purposes. You can also request from us to stop sending you newsletters.
                    AfricanSights abides by GDPR regulations, so if you wish to have your information (e.g. comments removed)  please get in touch with us. We are happy to amend or remove your information, comments or email from the mailing list if you contact us. We do not retain secondary copies of commenters or reader contact information without permission.
                    Similarly, we do not resell or share your contact information with third parties. Once you opt out of the mailing list, you are permanently removed.</p>
               <h4> How your information may be used</h4>
                <ul>
                    <li>To operate and maintain the Website;</li>
                    <li>To send you newsletters. Each email promotion will provide an easy opt-out button;</li>
                    <li>To respond to your comments or inquiries;</li>
                    <li>To track and measure statistics and advertising on the Website;</li>
                    <li>To protect, investigate, and deter against unauthorised or illegal activity.</li>
                </ul>
                <h4>Where do we send your data</h4>
                <p>Visitor comments may be checked through an automated spam detection service.</p>
                <h4>Contact information</h4>
               <p> If you have any questions about our Privacy Policy, please get in touch.</p>

            </div>


        </div>

    </div>
@endsection
