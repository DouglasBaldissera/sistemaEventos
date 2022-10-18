# sistemaEventos
Software de sistema de eventos criado na disciplina de Arquitetura de Software no curso de Engenharia da Computação pela Univates.

Imaginemos um pequeno sistema para gerência de eventos. Os usuários podem acessar o portal, pesquisar por eventos disponíveis e inscrever-se. Após a inscrição, é permitido ao usuário consultar suas inscrições e também cancelar, desde que dentro do período aceitável para cancelamento.

Ao comparecer no evento, os atendentes realizam o checkin dos participantes. Um participante não inscrito pode fazer checkin mediante um cadastro básico e rápido na portaria do evento. Os dados completos desse usuário devem ser preenchidos posteriormente por ele no próprio sistema.


Após o encerramento do evento é permitido aos usuários emitir seu certificado de participação. Para isso, é fornecida uma interface ao usuário onde são listados todos os eventos que o mesmo participou, permitindo seleção de geração de certificado. Ainda sobre os certificados, esses possuem um código único de autenticação impresso no próprio documento, acompanhado de um endereço para validação digital desse certificado.

O sistema envia e-mail a cada atividade que altere dados no sistema de inscrições, sejam elas: inscrição,
cancelamento, comparecimento e emissão de certificado.