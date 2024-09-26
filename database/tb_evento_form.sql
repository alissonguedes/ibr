CREATE tb_evento_form (

    id int(11) unsigned not null auto_increment,
    id_evento int(11) unsigned not null,
    
    CONSTRAINT fk_tb_evento_forms_id_evento foreign key (id_evento) references tb_evento (id)
    
) engine=innodb comment='Formulário de inscrição para eventos';

CREATE tb_evento_form (

    id int(11) unsigned not null auto_increment,
    label varchar(255) not null,
    name varchar(255) not null,
    disabled  boolean default false,
    maxlength int(11) null,
    tipo      enum('text', 'num',     
    
) engine=innodb comment='Tabela de campos do formulário';
