<?php

namespace Webkul\CMS\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CMSPagesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('cms_pages')->delete();
        DB::table('cms_page_translations')->delete();

        DB::table('cms_pages')->insert([
            [
                'id'         => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id'         => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id'         => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id'         => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id'         => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id'         => 6,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id'         => 7,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id'         => 8,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id'         => 9,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id'         => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id'         => 11,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id'         => 12,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        DB::table('cms_page_translations')->insert([
            [
                'locale'           => 'en',
                'cms_page_id'      => 1,
                'url_key'          => 'about-us',
                'html_content'     => "<p>@include('shop::about')</p>",
                'page_title'       => 'About Us',
                'meta_title'       => 'about us',
                'meta_description' => '',
                'meta_keywords'    => 'aboutus',
            ], [
                'locale'           => 'en',
                'cms_page_id'      => 2,
                'url_key'          => 'return-policy',
                'html_content'     => '<div class="static-container">
<div class="mb-5">
<div class="mb-5">You can return or exchange any item within 14 days from receipt of delivery.</div>
<div class="mb-5"></div>
<div class="mb-5"><strong>If you wish to return a product</strong></div>
<div class="mb-5"></div>
<div class="mb-5">Contact us with your order number and the item you wish to return within 14 days.</div>
<div class="mb-5">Email:webkatarinazlajic@gmail.com&nbsp;</div>
<div class="mb-5">Phone: +38267630083</div>
<div class="mb-5"></div>
<div class="mb-5">The deadline is met if you send back the goods before the period of 14 days has expired. Arrange to ship the product back, using a trackable and signed for delivery service.&nbsp;</div>
<div class="mb-5"></div>
<div class="mb-5">Please note, you will have to bear the cost for returning the product. You are only liable for any diminished value of the goods resulting from the handling other than what is necessary to establish the nature, characteristics and functioning of the goods</div>
<div class="mb-5"></div>
<div class="mb-5">Once a return has been received and accepted, we will arrange for a refund back to the original payment method (this may take up to 30 days to appear on your statement). Please allow up to 30 days for the refund to appear back on your statement.</div>
<div class="mb-5">Items returned must be in their original condition.</div>
<div class="mb-5"></div>
<div class="mb-5">Please prevent damage to and contamination of the goods. Please return the goods, if possible, in the original packaging with all accessories and all packaging components. If necessary, please use protective outer packaging. If you are no longer in possession of the original packaging, please use suitable packaging providing adequate protection against potential transport damage.</div>
<div class="mb-5"></div>
<div class="mb-5">Products not eligible for a return or exchange include:</div>
<div class="mb-5"></div>
<div class="mb-5">-Personalised items that are specially made or ordered for customers, e.g. Made to Order Range, items with a name on it;</div>
<div class="mb-5">-Products marked &ldquo;sale&rdquo;;</div>
<div class="mb-5">-Personal products such as earrings and hair accessories;</div>
<div class="mb-5">-Products that are made up in your own choice of fabric or material, or specially commissioned for the Buyer. (&ldquo;closed-out products&rdquo;); and</div>
<div class="mb-5">-Gift Cards</div>
<div class="mb-5"></div>
<div class="mb-5">If a product is faulty, you will be required to take photo proof of the faulty product and the packaging it arrived in, within two days of receipt of delivery and send the photo to us. For all faulty items you will be offered a replacement or repair, or a full refund.</div>
</div>
</div>',
                'page_title'       => 'Return Policy',
                'meta_title'       => 'return policy',
                'meta_description' => '',
                'meta_keywords'    => 'return, policy',
            ], [
                'locale'           => 'en',
                'cms_page_id'      => 3,
                'url_key'          => 'refund-policy',
                'html_content'     => 'Refund policy page content',
                'page_title'       => 'Refund Policy',
                'meta_title'       => 'Refund policy',
                'meta_description' => '',
                'meta_keywords'    => 'refund, policy',
            ], [
                'locale'           => 'en',
                'cms_page_id'      => 4,
                'url_key'          => 'terms-conditions',
                'html_content'     => `<div class="static-container">
<div class="mb-5">
<div class="mb-5"><strong>ARTICLE 1. Scope of Application</strong></div>
<div class="mb-5"></div>
<div class="mb-5">1.1. These General Terms and Conditions of the company Katarina Zlajic (hereinafter referred to as "Seller&rdquo;) shall apply to all contracts concluded between a consumer or a trader (hereinafter referred to as "Client&rdquo;) and the Seller relating to all goods and/or services presented in the Seller's online shop. The inclusion of the Client&rsquo;s own conditions is herewith objected to, unless other terms have been stipulated.</div>
<div class="mb-5"></div>
<div class="mb-5">1.2. A consumer pursuant to these Terms and Conditions is any natural person concluding a legal transaction for a purpose attributed neither to a mainly commercial nor a self-employed occupational activity. A trader pursuant to these Terms and Conditions is any natural or legal person or partnership with legal capacity acting in the performance of a commercial or self-employed occupational activity when concluding a legal transaction.</div>
<div class="mb-5"></div>
<div class="mb-5">1.3. Digital content in the sense of these General Terms and Conditions are all data not on a tangible medium which are produced in digital form and are supplied by the Seller by granting certain usage rights precisely defined in these General Terms and Conditions.</div>
<div class="mb-5"></div>
<div class="mb-5"></div>
<div class="mb-5"><strong>ARTICLE 2. Conclusion of the Contract</strong></div>
<div class="mb-5"></div>
<div class="mb-5">2.1. The product descriptions in the Seller&rsquo;s online shop do not constitute binding offers on the part of the Seller, but merely serve the purpose of submitting a binding offer by the Client.</div>
<div class="mb-5"></div>
<div class="mb-5">2.2. The Client may submit the offer via the online order form integrated into the Seller's online shop. In doing so, after having placed the selected goods and/or services in the virtual basket and passed through the ordering process, and by clicking the button finalizing the order process, the Client submits a legally binding offer of contract with regard to the goods and/or services contained in the shopping cart.</div>
<div class="mb-5"></div>
<div class="mb-5">2.3. The Seller may accept the Client&rsquo;s offer within five days,</div>
<div class="mb-5">- by transferring a written order confirmation or an order confirmation in written form (fax or e-mail); insofar receipt of order confirmation by the Client is decisive, or</div>
<div class="mb-5">- by delivering ordered goods to the Client; insofar receipt of goods by the customer is decisive, or</div>
<div class="mb-5">- by requesting the Client to pay after he placed his order.</div>
<div class="mb-5">Provided that several of the aforementioned alternatives apply, the contract shall be concluded at the time when one of the aforementioned alternatives firstly occurs. Should the Seller not accept the Client&rsquo;s offer within the aforementioned period of time, this shall be deemed as rejecting the offer with the effect that the Client is no longer bound by his statement of intent.</div>
<div class="mb-5"></div>
<div class="mb-5">2.4. When submitting an offer via the Seller's online order form, the text of the contract is stored by the Seller after the contract has been concluded and transmitted to the Client in text form (e.g. e-mail, fax or letter) after the order has been sent. The seller shall not make the contract text accessible beyond this. If the Client has set up a user account in the Seller's online shop prior to sending his order, the order data shall be stored on the Seller's website and can be accessed by the Client free of charge via his password-protected user account by specifying the corresponding login data.</div>
<div class="mb-5"></div>
<div class="mb-5">2.5. The English language is exclusively available for the conclusion of the contract.</div>
<div class="mb-5"></div>
<div class="mb-5">2.6. Order processing and contacting usually takes place via e-mail and automated order processing. It is the Client&rsquo;s responsibility to ensure that the e-mail address he provides for the order processing is accurate so that e-mails sent by the Seller or by third parties commissioned by the Seller with the order processing can be delivered.</div>
<div class="mb-5"></div>
<div class="mb-5">2.7.Upon notification of a Customer Order, the Seller will aim to fulfil the Order by shipping the relevant product within 1-2 Business days or within such other period as specified in the Seller Store , as some products (e.g. Made to Order) may take longer to ship.</div>
<div class="mb-5">The simple overrun of the delivery time does not give any right to compensation.</div>
<div class="mb-5"></div>
<div class="mb-5">2.8. Delivery tracking upon issuing an Acknowledgement, an order tracking number shall be provided to the Customer to enable the latter to track the progress of the delivery of their Order.</div>
<div class="mb-5"></div>
<div class="mb-5"></div>
<div class="mb-5"><strong>ARTICLE 3. Prices and Payment Conditions</strong></div>
<div class="mb-5"></div>
<div class="mb-5">3.1. By placing an Order, the Customer accepts the prices and descriptions of the goods which are offered for sale on the Web Site. Unless otherwise stated in the Seller&rsquo;s product description, prices indicated are total prices including the statutory sales tax. All descriptions of products or product pricing are subject to change at any time without notice. Delivery costs, where appropriate, will be indicated separately in the respective product description</div>
<div class="mb-5"></div>
<div class="mb-5">3.2. Payment can be made using one of the methods mentioned in the Seller&rsquo;s online shop. The Customer must pay for goods when it places the Order by providing their credit card details.</div>
<div class="mb-5"></div>
<div class="mb-5">3.3. An immediate reimbursement on the Customer&rsquo;s bank account in case of unavailability of a good shall not give any right to compensation to the Customer.</div>
<div class="mb-5"></div>
<div class="mb-5">3.4. When selecting the payment method credit card, the invoice amount is due immediately upon conclusion of the contract. Credit card information is always encrypted during transfer over networks. You agree to provide current, complete and accurate purchase and account information for all purchases made on our Website.</div>
<div class="mb-5"></div>
<div class="mb-5">3.5. When paying for an Order, the Customer provides the Vendor with an implied warranty that the Customer has the requisite authorisation to use the payment method the Customer elected upon placing their Order. Any Acknowledgement issued by the Vendor shall be subject to approval of the Customer&rsquo;s payment by the relevant electronic payment validation server. Should the Customer&rsquo;s bank reject the payment, the Order shall not be accepted and there shall be no obligation on the Vendor to dispatch the goods. As part of the measures taken to prevent fraud over the Internet, the Vendor shall be entitled to transmit information concerning the Order and the Customer&rsquo;s payment method to a third party for verification purposes.</div>
<div class="mb-5">The Vendor shall check any Orders which have been validated on the Web Site in conjunction with the bank in charge of handling the electronic payments. Thus the Vendor may verify any Order whose delivery address is different from the Customer&rsquo;s billing address. In doing so, the Vendor may ask the Customer to provide further information and documents required for the Order to proceed: evidence of the fact that the Customer and/or the person whose name was provided does indeed reside at the delivery address, the Customer&rsquo;s bank details, etc. These requests shall be forwarded to the Customer either by e-mail or over the telephone.</div>
<div class="mb-5"></div>
<div class="mb-5">The bank account linked to the payment method used by the Customer shall be debited as from the finalisation of the Order by the Customer on the Web Site. The Vendor shall be entitled to suspend or cancel any Order and/or any delivery, whatever the nature or state of progress thereof, if any monies due by the Customer are not paid in full, or if there are any other problems with the Customer&rsquo;s payment (&ldquo;Incident&rdquo;). If there has been a Customer Incident on a previous Order, any subsequent Orders placed by the Customer may be refused and any pending deliveries for the Customer may be suspended.</div>
<div class="mb-5"></div>
<div class="mb-5"></div>
<div class="mb-5"><strong>ARTICLE 4. Shipment and Delivery Conditions</strong></div>
<div class="mb-5"></div>
<div class="mb-5">4.1. Goods are generally delivered on dispatch route and to the delivery address indicated by the Client, unless agreed otherwise. During the processing of the transaction, the delivery address indicated in the Seller&rsquo;s order processing is decisive.</div>
<div class="mb-5"></div>
<div class="mb-5">4.2. Should the assigned transport company return the goods to the Seller, because delivery to the Client was not possible. This shall not apply, if the Client exercises his right to cancel effectively, if the delivery cannot be made due to circumstances beyond the Client's control or if he has been temporarily impeded to receive the offered service, unless the Seller has notified the Client about the service for a reasonable time in advance.</div>
<div class="mb-5"></div>
<div class="mb-5">4.3. Personal collection is not possible for logistical reasons.</div>
<div class="mb-5"></div>
<div class="mb-5"></div>
<div class="mb-5"><strong>ARTICLE 5. Reservation of Proprietary Rights</strong></div>
<div class="mb-5"></div>
<div class="mb-5">If the Seller provides advance deliveries, he retains title of ownership to the delivered goods, until the purchase price owed has been paid in full.</div>
<div class="mb-5"></div>
<div class="mb-5"></div>
<div class="mb-5"><strong>ARTICLE 6. Warranty</strong></div>
<div class="mb-5"></div>
<div class="mb-5">6.1. The Customer&rsquo;s right to change their mind. The Customer may, from the date on which the Customer places an Order, cancel that Order in respect one or more of the goods that are the subject of that Order and request reimbursement for same subject to provisions set out below.</div>
<div class="mb-5"></div>
<div class="mb-5">If the Customer wishes to cancel an Order in respect of certain good(s), the Customer has fourteen (14) days from delivery of the goods to do it, without having to provide a reason.</div>
<div class="mb-5"></div>
<div class="mb-5">The cancellation period expires fourteen (14) days after the day on which the Customer, or a third party other than the carrier and designated by him, physically took possession of the goods. In order to cancel their Order, the Customer returns the ordered products by contact Seller.</div>
<div class="mb-5"></div>
<div class="mb-5">Detailed informations about the right to cancel are provided in the Seller&rsquo;s instruction on cancellation.</div>
<div class="mb-5">Further to this if the goods are to be sent back the Customer is free to use the transporter of their choice.</div>
<div class="mb-5">The transport costs of the return package to the Vendor stay at the Customer&rsquo;s charge.</div>
<div class="mb-5"></div>
<div class="mb-5">The Vendor shall reimburse the Customer by the same means of payment that the Customer used for the initial transaction, unless expressly agreed otherwise. In any event, the Customer will not incur any fees as a result of the reimbursement.</div>
<div class="mb-5">The Vendor will reimburse the Customer within two (2) to three (3) days (variable delay according to the different banks) after the Vendor has collected the goods back or the Customer has supplied evidence of having sent back the goods, whichever of the two is the earliest.&rdquo;</div>
<div class="mb-5"></div>
<div class="mb-5">The Customer&rsquo;s cancellation of their Order shall only be taken into consideration provided that the goods for which the Customer is requesting reimbursement from the Vendor have been returned to the Vendor within the above mentioned delay of thirty (14) days.</div>
<div class="mb-5"></div>
<div class="mb-5">The Vendor may make a deduction from the reimbursement for loss in value of any goods supplied if the loss is the result of unnecessary handling by the Customer.</div>
<div class="mb-5"></div>
<div class="mb-5">6.2. The Client is asked to notify any obvious transport damages to the forwarding agent and to inform the Seller accordingly. Should the Client fail to comply therewith, this shall not affect his statutory or contractual claims for defects.</div>
<div class="mb-5"></div>
<div class="mb-5">6.3. Should the object of purchase be deficient, statutory provisions shall apply.</div>
<div class="mb-5"></div>
<div class="mb-5">6.4. The Client is asked to notify any obvious transport damages to the forwarding agent and to inform the Seller accordingly. Should the Client fail to comply therewith, this shall not affect his statutory or contractual claims for defects.</div>
<div class="mb-5"></div>
<div class="mb-5">6.5.These Terms of Service and any separate agreements whereby we provide you Services shall be governed by and construed in accordance with the laws of Montenegro.</div>
<div class="mb-5"></div>
<div class="mb-5"></div>
<div class="mb-5"><strong>ARTICLE 7. Contact us</strong></div>
<div class="mb-5"></div>
<div class="mb-5">SHAKA LABEL is an Montenegrin registered business, Zaton 44, Bijelo Polje. Contact or questions about these Terms &amp; Conditions can be made to SHAKA LABEL at webkatarinazlajic@gmail.com.</div>
<div class="mb-5"></div>
<div class="mb-5">Subscribe below for 10% off your first order &amp; stay friends with us.</div>
</div>
</div>`,
                'page_title'       => 'Terms & Conditions',
                'meta_title'       => 'Terms & Conditions',
                'meta_description' => '',
                'meta_keywords'    => 'term, conditions',
            ], [
                'locale'           => 'en',
                'cms_page_id'      => 5,
                'url_key'          => 'terms-of-use',
                'html_content'     => '<div class="static-container"><div class="mb-5">Terms of use page content</div></div>',
                'page_title'       => 'Terms of use',
                'meta_title'       => 'Terms of use',
                'meta_description' => '',
                'meta_keywords'    => 'term, use',
            ], [
                'locale'           => 'en',
                'cms_page_id'      => 6,
                'url_key'          => 'contact-us',
                'html_content'     => '<div class="static-container"><div class="mb-5">Contact us page content</div></div>',
                'page_title'       => 'Contact Us',
                'meta_title'       => 'Contact Us',
                'meta_description' => '',
                'meta_keywords'    => 'contact, us',
            ], [
                'locale'           => 'en',
                'cms_page_id'      => 7,
                'url_key'          => 'cutomer-service',
                'html_content'     => '<div class="static-container"><div class="mb-5">Customer service  page content</div></div>',
                'page_title'       => 'Customer Service',
                'meta_title'       => 'Customer Service',
                'meta_description' => '',
                'meta_keywords'    => 'customer, service',
            ], [
                'locale'           => 'en',
                'cms_page_id'      => 8,
                'url_key'          => 'whats-new',
                'html_content'     => '<div class="static-container"><div class="mb-5">What\'s New page content</div></div>',
                'page_title'       => 'What\'s New',
                'meta_title'       => 'What\'s New',
                'meta_description' => '',
                'meta_keywords'    => 'new',
            ], [
                'locale'           => 'en',
                'cms_page_id'      => 9,
                'url_key'          => 'payment-policy',
                'html_content'     => '<div class="static-container"><div class="mb-5">Payment Policy page content</div></div>',
                'page_title'       => 'Payment Policy',
                'meta_title'       => 'Payment Policy',
                'meta_description' => '',
                'meta_keywords'    => 'payment, policy',
            ], [
                'locale'           => 'en',
                'cms_page_id'      => 10,
                'url_key'          => 'shipping-policy',
                'html_content'     => '<div class="static-container"><div class="mb-5">Shipping Policy  page content</div></div>',
                'page_title'       => 'Shipping Policy',
                'meta_title'       => 'Shipping Policy',
                'meta_description' => '',
                'meta_keywords'    => 'shipping, policy',
            ], [
                'locale'           => 'en',
                'cms_page_id'      => 11,
                'url_key'          => 'privacy-policy',
                'html_content'     => '<div class="static-container">
<div class="mb-5">
<div class="mb-5"><strong>Information on the Collection of Personal Data and Contact Details of the Controller</strong></div>
<div class="mb-5"></div>
<div class="mb-5">We are pleased that you are visiting our website and thank you for your interest. In the following pages, we inform you about the handling of your personal data when using our website. Personal data is all data with which you can be personally identified.</div>
<div class="mb-5"></div>
<div class="mb-5">The controller in charge of data processing on this website, within the meaning of the General Data Protection Regulation (GDPR), is Katarina Zlajic, Zaton 44, Bijelo Polje, Tel.: +38267630083 E-Mail: webkatarinazlajic@gmail.com The controller in charge of the processing of personal data is the natural or legal person who alone or jointly with others determines the purposes and means of the processing of personal data.</div>
<div class="mb-5"></div>
<div class="mb-5"></div>
<div class="mb-5"><strong>Data Collection When You Visit Our Website</strong></div>
<div class="mb-5"></div>
<div class="mb-5">When using our website for information only, i.e. if you do not register or otherwise provide us with information, we only collect data that your browser transmits to our server (so-called "server log files").&nbsp;</div>
<div class="mb-5"></div>
<div class="mb-5">When you visit our website, we collect the following data that is technically necessary for us to display the website to you:</div>
<div class="mb-5"></div>
<p>- Our visited website</p>
<p>- Date and time at the moment of access</p>
<p>- Amount of data sent in bytes</p>
<p>- Source/reference from which you came to the page</p>
<p>- Browser used</p>
<p>- Operating system used</p>
<p>- IP address used (if applicable: in anonymized form)</p>
<div class="mb-5"></div>
<div class="mb-5">The data will not be passed on or used in any other way. However, we reserve the right to check the server log files subsequently, if there are any concrete indications of illegal use.</div>
<div class="mb-5"></div>
<div class="mb-5"></div>
<div class="mb-5"><strong>Cookies</strong></div>
<div class="mb-5"></div>
<div class="mb-5">In order to make your visit to our website attractive and to enable the use of certain functions, we use so-called cookies on various pages. These are small text files that are stored on your end device. Some of the cookies we use are deleted after the end of the browser session, i.e. after closing your browser (so-called session cookies). Other cookies remain on your terminal and enable us or our partner companies (third-party cookies) to recognize your browser on your next visit (persistent cookies). If cookies are set, they collect and process specific user information such as browser and location data as well as IP address values according to individual requirements. Persistent cookies are automatically deleted after a specified period, which may vary depending on the cookie.</div>
<div class="mb-5"></div>
<div class="mb-5">In some cases, cookies are used to simplify the ordering process by saving settings (e.g. remembering the content of a virtual shopping basket for a later visit to the website).</div>
<div class="mb-5"></div>
<div class="mb-5">We work together with advertising partners who help us to make our website more interesting for you. For this purpose, cookies from partner companies are also stored on your hard drive when you visit our website (third-party cookies). You will be informed individually and separately about the use of such cookies and the scope of the information collected in each case within the following sections.</div>
<div class="mb-5"></div>
<div class="mb-5">Please note that you can set your browser in such a way that you are informed about the setting of cookies and you can decide individually about their acceptance or exclude the acceptance of cookies for certain cases or generally. Each browser differs in the way it manages the cookie settings.</div>
<div class="mb-5"></div>
<div class="mb-5">Please note that the functionality of our website may be limited if cookies are not accepted.</div>
<div class="mb-5"></div>
<div class="mb-5"></div>
<div class="mb-5"><strong>Contacting Us</strong></div>
<div class="mb-5"></div>
<div class="mb-5">When you contact us (e.g. via contact form or e-mail), personal data is collected. Which data is collected in the case of a contact form can be seen from the respective contact form. These data are stored and used exclusively for the purpose of responding to your request or for establishing contact and for the associated technical administration. The legal basis for processing data is our legitimate interest in responding to your request.</div>
<div class="mb-5"></div>
<div class="mb-5"></div>
<div class="mb-5"><strong>Data Processing When Opening a Customer Account and for Contract Processing</strong></div>
<div class="mb-5"></div>
<div class="mb-5">Personal data will continue to be collected and processed if you provide them to us for the execution of a contract or when opening a customer account. Which data is collected can be seen from the respective input forms. It is possible to delete your customer account at any time. This can be done by sending a message to the above-mentioned address of the controller. We store and use the data provided by you for contract processing. After complete processing of the contract or deletion of your customer account, your data will be blocked in consideration of tax and commercial retention periods and deleted after expiry of these periods, unless you have expressly consented to further use of your data or a legally permitted further use of data has been reserved by our site, about which we will inform you accordingly below.</div>
<div class="mb-5"></div>
<div class="mb-5"></div>
<div class="mb-5"><strong>Use of Your Data for Direct Advertising</strong></div>
<div class="mb-5"></div>
<div class="mb-5">If you subscribe to our e-mail newsletter, we will send you regular information about our offers. The only mandatory information for sending the newsletter is your e-mail address. The indication of additional possible data is voluntary and is used to be able to address you personally. We use the so-called double opt-in procedure for sending the newsletter. This means that we will not send you an e-mail newsletter, unless you have expressly confirmed to us that you agree to the sending of the newsletter. We will then send you a confirmation e-mail asking you to confirm that you wish to receive future newsletters by clicking on an appropriate link.</div>
<div class="mb-5"></div>
<div class="mb-5">By activating the confirmation link, you give us your consent to the use of your personal data. When you register for the newsletter, we store your IP address entered by the Internet Service Provider (ISP) as well as the date and time of registration so that we can trace any possible misuse of your e-mail address at a later time. The data collected by us when you register for the newsletter will be used exclusively for the purpose of advertising by means of the newsletter. You can unsubscribe from the newsletter at any time via the link provided in the newsletter or by sending a message to the responsible person named above. After your cancellation, your e-mail address will immediately be deleted from our newsletter distribution list, unless you have expressly consented to further use of your data or we reserve the right to use data in excess thereof, which is permitted by law and about which we inform you in this declaration.</div>
<div class="mb-5"></div>
<div class="mb-5"></div>
<div class="mb-5"><strong>Processing of Data for the Purpose of Order Handling</strong></div>
<div class="mb-5"></div>
<div class="mb-5">The personal data collected by us will be passed on to the transport company commissioned with the delivery within the scope of contract processing, insofar as this is necessary for the delivery of the goods. We will pass on your payment data to the commissioned credit institution within the framework of payment processing, if this is necessary for payment handling.</div>
<div class="mb-5"></div>
<div class="mb-5"></div>
<div class="mb-5"><strong>Duration of Storage of Personal Data</strong></div>
<div class="mb-5"></div>
<div class="mb-5">The duration of the storage of personal data is determined by the respective legal retention period (e.g. commercial and tax retention periods). After expiry of this period, the corresponding data will be routinely deleted, provided they are no longer necessary for the performance or initiation of the contract and/or there is no longer any legitimate interest on our part in further storage.</div>
</div>
</div>',
                'page_title'       => 'Privacy Policy',
                'meta_title'       => 'Privacy Policy',
                'meta_description' => '',
                'meta_keywords'    => 'privacy, policy',
            ],
            [
                'locale'           => 'en',
                'cms_page_id'      => 12,
                'url_key'          => 'behind-the-scenes',
                'html_content'     => "<p>@include('shop::behind-the-scenes')</p>",
                'page_title'       => 'Behind the Scenes',
                'meta_title'       => 'Behind the Scenes',
                'meta_description' => 'Behind the Scenes',
                'meta_keywords'    => 'shaka behind the scenes',
            ],
        ]);
    }
}