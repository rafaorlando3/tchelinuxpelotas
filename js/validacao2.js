var $R=jQuery.noConflict();
$R(document).ready(function(){
        $R('#cadastros2').validate({
            rules: {
                nome2: {
                    required: true,
                    minlength: 3,
                    maxlength: 70
                },
                telefone2: {
                    required: true,
                    minlength: 8,
                    maxlength: 25
                },
                cidade2: {
                    required: true,
                    minlength: 3,
                    maxlength: 25
                },
                estado2: {
                    required: true
                },
                rg2: {
                    required: true,
                    minlength: 8,
                    maxlength: 12,
                    number: true
                },
                email2: {
                    required: true,
                    email: true
                }
            },
            messages: {
                nome2: {
                    required: "<span style='color:#D97655;'><br/>O campo nome é obrigatório.</span>",
                    minlength: "<span style='color:#D97655;'><br/>O campo nome deve conter no mínimo 3 caracteres.</span>",
                    maxlength: "<span style='color:#D97655;'><br/>O campo nome deve conter no máximo 70 caracteres.</span>"
                },
                telefone2: {
                    required: "<span style='color:#D97655;'><br/>O campo telefone é obrigatório.</span>",
                    minlength: "<span style='color:#D97655;'><br/>O campo telefone deve conter no mínimo 8 caracteres.</span>",
                    maxlength: "<span style='color:#D97655;'><br/>O campo telefone deve conter no máximo 25 caracteres.</span>"
                },
                cidade2: {
                    required: "<span style='color:#D97655;'><br/>O campo cidade é obrigatório.</span>",
                    minlength: "<span style='color:#D97655;'><br/>O campo cidade deve conter no mínimo 3 caracteres.</span>",
                    maxlength: "<span style='color:#D97655;'><br/>O campo cidade deve conter no máximo 25 caracteres.</span>"
                },
                estado2: {
                    required: "<span style='color:#D97655;'><br/>O campo estado é obrigatório.</span>"
                },
                rg2: {
                    required: "<span style='color:#D97655;'><br/>O campo RG é obrigatório.</span>",
                    minlength: "<span style='color:#D97655;'><br/>O campo RG deve conter no mínimo 8 caracteres.</span>",
                    maxlength: "<span style='color:#D97655;'><br/>O campo RG deve conter no máximo 12 caracteres.</span>",
                    number: "<span style='color:#D97655;'><br/>O campo RG deve ser apenas números.</span>"
                },
                email2: {
                    required: "<span style='color:#D97655;'><br/>O campo email é obrigatório.",
                    email: "<span style='color:#D97655;'><br/>O campo email deve conter um email válido.</span>"
                }
            }
 
	        });
	    });
            
            
            /*
*  Exemplo original de Matheus Biagini de Lima Dias.   
*/
        /*Função Pai de Mascaras*/
        function Mascara(o,f){
                v_obj=o
                v_fun=f
                setTimeout("execmascara()",1)
        }
        
        /*Função que Executa os objetos*/
        function execmascara(){
                v_obj.value=v_fun(v_obj.value)
        }
        
        /*Função que Determina as expressões regulares dos objetos*/
        function leech(v){
                v=v.replace(/o/gi,"0")
                v=v.replace(/i/gi,"1")
                v=v.replace(/z/gi,"2")
                v=v.replace(/e/gi,"3")
                v=v.replace(/a/gi,"4")
                v=v.replace(/s/gi,"5")
                v=v.replace(/t/gi,"7")
                return v
        }
        
        /*Função que padroniza telefone (11) 4184-1241*/
        function Telefone(v){
                v=v.replace(/\D/g,"")                            
                v=v.replace(/^(\d\d)(\d)/g,"($1) $2") 
                v=v.replace(/(\d{4})(\d)/,"$1-$2")      
                return v
        }
        
        /*Função que padroniza telefone (11) 41841241*/
        function TelefoneCall(v){
                v=v.replace(/\D/g,"")                            
                v=v.replace(/^(\d\d)(\d)/g,"($1) $2")   
                return v
        }


