## Resumo
Primeiramente gostaria de agradecer à todos pela oportunidade de poder me juntar ao time de desenvolvimento da <a href="https://quero.education/">Quero Educação</a>.

<b>Link para a API: <b> <a href="#">Quero Educação</a>

Esse projeto demonstra apenas algumas de minhas habilidades com POO (Programação orientada à objetos), Laravel 6 e PHP7. O Laravel possui muitos recursos avançados para projetos mais complexos. É um framework excelente para se trabalhar com arrays e estrutura de dados e, por isso, foi tranquilo implementar a solução lógica para o problema proposto. 

Infelizmente, pela decorrência dos poucos dias para resolução desse problema e motivos particulares, não pude implementar todos os recursos avançados que eu gostaria. Acrescento também, que o código pode ser melhorado para que a performace do projeto seja beneficiada. Por isso deixarei aqui um link para um projeto meu no GitHub que explora algumas técnicas avançadas de Laravel como: Service Container, Macros, Pipelines, Repository Pattern e etc.

<a href="https://github.com/Pedr0visk/Laravel-Advanced-6">Link para o projeto no GitHub</a>


## O Problema - Solução

A chave para resolver o problema proposto, era achar a maneira mais equilibrada de encaixar as sessões em uma trilha e fazer com que essas sessões se encaixassem perfeitamente no intervalo de tempo de um dia de palestra, ou seja, uma palestra não pode ficar ociosa. Esse problema lembra um pouco como funciona o gerenciador de tarefas de um processador. Existem alguns algoritmos para a resolução de problemas similares, mas para esse em questão eu desenvolvi o meu próprio.

Através da modelagem matemática eu percebi que eu poderia criar uma relação "peso x quantidade" das sessões pois, como que todos os horários são multíplos de 5, podemos ter uma novo atributo chamado peso.
Sendo assim, consegui visualizar uma maneira de encaixar uma palestra em função da relação "peso x quantidade". Aí para resolver o problema, bastou criar essa relação através de uma matriz 3D que relacionava esses 3 atributos: peso, quantidade, pesoXquantidade, para podermos decidir qual caminho da árvore de possibilidades iríamos descer.

Acredito que o meu algoritmo possa ser melhorado afim de reduzir a sua complexidade para O(n log n).

## Arquitetura da aplicação
Procurei utilizar o padrão de desenvolvimento SOLID. 
Motivos:
- Menor acoplamento entre as classes
- Menor esforço na manutenção, correção ou evolução do código
- Código limpo e organizado
- Torna o projeto escalável, entre outros.

Para lidar com arrays e estrutura de dados, eu fiz o uso da classe Colletion do Laravel, que proporciona maior flexibildade e performace na hora do desenvolvimento.


