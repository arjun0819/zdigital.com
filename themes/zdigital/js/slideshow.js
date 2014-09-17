/**
 * 
 */
(function($){
	
	$.fn.aj_slideshow = function(options){
		this.settings = {
				delay: 7000,
				auto_trigger: true
		};
		$.extend(this.settings, options);

		var self = this;
		self.slides = [];
		
		var bottom_html = "";
		$('.sl_content .slide li').each(function(k, v){
			if(k != 0) {
				$(this).hide();
			}
			self.slides[k] = v;
			
			bottom_html += "<li><span></span></li>";
		});
		bottom_html = "<ul class='sl_bottom'>"+bottom_html+"</ul>";
		
		$(".sl_content", this).append(bottom_html);
		
		if(self.slides.length <= 0) {
			return '';
		}
		
		$(".sl_controller", this).append('<a href="#" class="prev"></a><a href="#" class="next"></a>')
		
		var wrapper_width = $(this).width() / self.slides.length;
		
		var bg_color = ['#363636', '#161616'], bg_color_key = ['1', '0'], i=1;
		$(".sl_bottom li", this).each(function(){
			
			i = bg_color_key[i];
			this.bg_color = bg_color[i];
			$(this).css({backgroundColor: this.bg_color, width: wrapper_width});
		});
		
		self.current = 0;
		var active_bg_color = '#cc0000';
		$('.sl_bottom li:eq('+self.current+')', self).css({backgroundColor: active_bg_color});
		
		$('.sl_controller a:eq(0)', self).bind('click', function(e){
			e.preventDefault();
			
			$(self.slides[self.current]).hide();
			$('.sl_bottom li:eq('+self.current+')', self).css({backgroundColor: $('.sl_bottom li:eq('+self.current+')', self)[0].bg_color});
			
			var prev_key = self.current == 0 ? self.slides.length - 1 : self.current - 1;
			self.current = prev_key;
			$(self.slides[self.current]).show();
			$('.sl_bottom li:eq('+self.current+')', self).css({backgroundColor: active_bg_color});
		}).addClass('prev');
		
		$('.sl_controller a:eq(1)', self).bind('click', function(e){
			e.preventDefault();

			$(self.slides[self.current]).hide();
			$('.sl_bottom li:eq('+self.current+')', self).css({backgroundColor: $('.sl_bottom li:eq('+self.current+')', self)[0].bg_color});
			
			var next_key = self.current == self.slides.length - 1 ? 0 : self.current + 1;
			self.current = next_key;
			$(self.slides[self.current]).show();
			$('.sl_bottom li:eq('+self.current+')', self).css({backgroundColor: active_bg_color});
		}).addClass('next');
		
		var dida_function = function(){
			$('a.next', self).trigger('click');
		};
		self.dida = setInterval(dida_function, self.settings.delay);
		$(this).hover(function(){
			clearInterval(self.dida);
		}, function(){
			self.dida = setInterval(dida_function, self.settings.delay);
		});
		
		// dynamic width
		$(window).bind('resize', function(){
			var wrapper_width = $(self).width() / self.slides.length;
			$(".sl_bottom li", self).each(function(){
				$(this).css({width: wrapper_width});
			})
		});
		
		return this;
	}
})(jQuery);