if (!Array.isArray(message)) {
  Object.keys(message).forEach((key) => {
    Toast.fire({
      icon: key,
      title: message[key],
    });
  });
}
