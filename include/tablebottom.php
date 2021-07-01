            </tbody>

		</table>

	</div>	

</div>

<div class = "row" id = "bottom">

<div class="rowtools">

    <?php echo $functions; ?>    
    
    
</div>

</div>
</div>
</div>

<script src="../js/wow.min.js"></script>
<script>new WOW().init();</script>

<script>
var test = document.querySelector('.myshadow');
var rng = document.getElementById('rng');

rng.onchange = rng.oninput = function() {
test.style.setProperty('--var-width', this.value + '%');
};
</script>

<script>
var font = document.querySelector('.myshadow');
var fnt = document.getElementById('font');

rng.onchange = fnt.oninput = function() {
font.style.setProperty('--var-font-size', this.value + '%');
};


</script>
</body>
</html>