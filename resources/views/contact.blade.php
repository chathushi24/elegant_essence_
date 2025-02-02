@extends('layouts.app')
@section('content')

<section class="text-center text-pink-600 text-4xl font-semibold py-6">
        <h2>Contact Us</h2>
    </section>

    <section id="about-head" class="flex items-center px-10 py-10">
        <img class="w-6/12 h-auto object-cover" src="storage/images/abouthead.jpg" alt="About Us">
        <div class="w-6/12 pl-10">
            <p class="text-gray-700 leading-relaxed"> 
                Elegant Essence, your premier destination for chic, sophisticated, and trendy women's fashion. Founded in 2024, our mission is to bring you the latest styles and timeless classics that embody elegance and essence in every stitch.<br><br>

                At Elegant Essence, we believe that fashion is more than just clothing—it's a form of self-expression and confidence. Our carefully curated collections are designed to cater to the modern woman who appreciates quality, style, and versatility. From casual wear to statement pieces, each item is selected with attention to detail and a passion for fashion.<br><br>

                We are committed to providing an exceptional shopping experience, with a focus on personalized customer service, fast shipping, and a seamless online shopping journey. Whether you're looking for the perfect outfit for a special occasion or everyday essentials that elevate your style, Elegant Essence is here to inspire and empower you.<br><br>

                Join us on this fashionable journey and discover the essence of elegance with our exclusive collections. Thank you for choosing Elegant Essence, where every piece tells a story, and every woman shines with confidence.<br>
            </p>
            <div class="mt-6 bg-pink-200 p-2 text-center animate-pulse">
                Embrace yourself with Elegant Essence and shine brighter
            </div>
        </div>
    </section>

    <section id="contact-details" class="flex justify-between px-10 py-10 space-x-10">
        <div class="w-2/5">
            <span class="text-pink-600 font-bold">GET IN TOUCH</span>
            <h2 class="text-2xl font-semibold py-5">Visit our website and contact with us today</h2>
            <h3 class="text-lg font-medium pb-4">Head Office</h3>
            <ul class="space-y-3">
                <li class="flex items-center space-x-4">
                    <i class="fal fa-map"></i>
                    <p class="text-gray-700">613 park street, Union place, Colombo 02</p>
                </li>
                <li class="flex items-center space-x-4">
                    <i class="fal fa-envelope"></i>
                    <p class="text-gray-700">elegentessence@gmail.com</p>
                </li>
                <li class="flex items-center space-x-4">
                    <i class="fal fa-phone-alt"></i>
                    <p class="text-gray-700">+94 0112918753</p>
                </li>
                <li class="flex items-center space-x-4">
                    <i class="fal fa-clock"></i>
                    <p class="text-gray-700">09:00 - 18:00, Monday - Saturday</p>
                </li>
            </ul>
        </div>
        <div class="w-2/5">
        <form action="{{ route('contact') }}" method="POST" class="flex flex-col space-y-4">
            @csrf
            <h2 class="text-2xl font-semibold text-center py-5">We love to hear from you</h2>
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif
            
            <input type="text" name="name" placeholder="Your name" required 
                class="w-full p-3 border border-gray-300 rounded">
            
            <input type="email" name="email" placeholder="E-mail" required 
                class="w-full p-3 border border-gray-300 rounded">
            
            <input type="text" name="subject" placeholder="Subject" required 
                class="w-full p-3 border border-gray-300 rounded">
            
            <textarea name="message" placeholder="Your message" rows="5" required 
                    class="w-full p-3 border border-gray-300 rounded"></textarea>
            
            <button type="submit" 
                    class="bg-pink-600 text-white py-3 rounded hover:bg-pink-700 transition duration-300">
                Submit
            </button>
    </form>
    </div>
    </section>

    <section id="map" class="w-full h-[550px]">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.7803702095953!2d79.85630747522056!3d6.916841118467029!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2596c60bdc389%3A0x9d8ed733e06cf0c5!2sPark%20Street%20Mews!5e0!3m2!1sen!2slk!4v1726158748605!5m2!1sen!2slk" 
            class="w-full h-full border-0" 
            allowfullscreen 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </section>
<br>
<br>

@endsection