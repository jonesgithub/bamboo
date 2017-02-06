#!/usr/bin/python  
# -*- coding: utf-8 -*-  
  
__author__ = 'Toger'  
  
  
import os  
import preppy  
import logging  
import traceback  
import trml2pdf  
#from django.conf import settings  
  
import reportlab.lib.styles  
from reportlab.pdfbase import pdfmetrics, ttfonts  
from reportlab.lib.fonts import addMapping  
  
operation_logger = logging.getLogger('operation')  
bug_log = logging.getLogger('bug')  
  
  
class PDFUtils(object):  
  
    """ PDF 生成工具类  
 
    将一个标准的RML文件正常解析为PDF文件，保存并返回。具体参数如下"""  
  
    def __init__(self, font_dir='/usr/share/fonts/Windows/',  
            static_dir='/home/hbu/bamboo/tools'):  
        """ 构造方法 
 
        @param font_dir 需要注册的字体文件目录 
        @param static_dir 静态文件地址目录  
        """  
  
        super(PDFUtils, self).__init__()  
        self.STATIC_DIR = static_dir  
        try:  
            # 注册宋体字体  
            pdfmetrics.registerFont(ttfonts.TTFont('song', os.path.join(font_dir, 'STSONG.TTF')))  
            # 注册宋体粗体字体  
            pdfmetrics.registerFont(ttfonts.TTFont('song_b', os.path.join(font_dir, 'STZHONGS.TTF')))  
        except:  
            bug_log.error(traceback.format_exc())  
  
        addMapping('song', 0, 0, 'song')     # normal  
        addMapping('song', 0, 1, 'song')     # italic  
        addMapping('song', 1, 1, 'song_b')     # bold, italic  
        addMapping('song', 1, 0, 'song_b')     # bold  
  
        # 设置自动换行  
        reportlab.lib.styles.ParagraphStyle.defaults['wordWrap'] = "CJK"  
  
  
    def create_pdf(self, data, templ, save_file):  
        """从二进制流中创建PDF并返回 
 
        @param data  渲染XML的数据字典 
        @param templ 需要渲染的XML文件地址（全路径） 
        @param save_file PDF文件保存的地址（全路径） 
        """  
        # 读取模板文件  
        template = preppy.getModule(templ)  
        # 渲染模板文件  
        namespace = {  
            'data': data,  
            'STATIC_DIR': self.STATIC_DIR,  
            }  
        # 渲染PDF页面  
        rml = template.getOutput(namespace)  
        # 生成PDF  
        pdf =  trml2pdf.parseString(rml)  
        # 保存PDF  
        open(save_file,'wb').write(pdf)  
        return True  
          
  
if __name__ == '__main__':  
      
    pu = PDFUtils()  
    # 模板页面地址  
    temp_path =  'doc.prep'  
    #for c in cerfts:  
    pdf_path = 'doc.pdf' 
    # 如果PDF不存在则重新生成  
    c = 'Toger#HBU'
    if not os.path.exists(pdf_path):  
        pu.create_pdf(c, temp_path, pdf_path)  
    print 'done'  
