@include('layouts.header')
        <div class="event-cart">
            <div class="caption">
                <p>Event Cart</p>
            </div>
            <div class="event">
                <div class="cart">
                    <img src="img/pics/event-cart.png" alt="">
                    <img class="cancel" src="img/pics/red-crose.png" alt="">
                </div>
                <div class="right-part">
                    <div class="price">
                        <h1>The Greatest Showman</h1>
                        <div class="button">
                            <p>Edit</p>
                        </div>
                        <p>Price: $200</p>
                        <p>QTY: 1</p>
                    </div>
                    <div class="discount active">
                        <input type="text" name="discount" placeholder="">
                        <p class="code">3WR567DFG78</p>
                        <img src="img/pics/red-crose.png" alt="">
                        <p>APLLY</p>
                    </div>
                    <p class="tot">Total: $150</p>
                </div>
            </div>
            <div class="event">
                <div class="cart">
                    <img src="img/pics/event-cart.png" alt="">
                    <img class="cancel" src="img/pics/red-crose.png" alt="">
                </div>
                <div class="right-part">
                    <div class="price">
                        <h1>The Greatest Showman</h1>
                        <div class="button">
                            <p>Edit</p>
                        </div>
                        <p>Price: $200</p>
                        <p>QTY: 1</p>
                    </div>
                    <div class="discount">
                        <input type="text" name="discount" placeholder="">
                        <p class="code">Discount code</p>
                        <img src="img/pics/red-crose.png" alt="">
                        <p>APLLY</p>
                    </div>
                    <p class="tot">Total: $50</p>
                </div>
            </div>
            <div class="total">
                <div class="right-part-tot">
                    <p>You buy 2 tickets.</p>
                    <h1>Total price: $200</h1>
                </div>
                <a href="buy-ticket">
                 <div class="button">
                       <p>BUY TICKET</p>
                 </div>
                </a>
            </div>
        </div>
@include('layouts.footer')