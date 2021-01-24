class ExpressionParser {
  static const delimiter = '/';
  String from, to;
  String expression;
  List<String> expressionSplitted;
  String text;
  bool replaceAll = false;
  bool deleteSource = false;

  String result;

  ExpressionParser({this.text, this.expression}) {
    if (expression.contains('//')) {
      deleteSource = true;
      expression = expression.replaceFirst('//', '/');
    }

    expressionSplitted = expression.split(delimiter);

    replaceAll = expressionSplitted.last == 'g';
    from = expressionSplitted.elementAt(1);
    to = expressionSplitted.elementAt(2);

    if (from == '*') {
      from = text;
    }

    result = run();
  }

  bool isValid() {
    if (expression[0] != 's') return false;
    if (!(expression.endsWith('/') || expression.endsWith('/g'))) return false;

    if (expressionSplitted.length <= 3 && expressionSplitted.length >= 4) {
      return false;
    }

    return true;
  }

  String run() {
    if (replaceAll) return text.replaceAll(from, to);

    return text.replaceFirst(from, to);
  }

  @override
  String toString() {
    return """
    delimiter: $delimiter,
    from: $from,
    to: $to,
    expression: $expression,
    expressionSplitted: ${expressionSplitted.join(', ')}
    text: $text,
    replaceAll: $replaceAll,
    deleteSource: $deleteSource

    result: $result
    """;
  }
}
