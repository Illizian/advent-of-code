package slice

func Splice[T any](slice []T, index, deleteCount int, values []T) []T {
	output := make([]T, 0, len(slice)+len(values)-deleteCount)

	output = append(output, slice[:index]...)
	output = append(output, values...)
	output = append(output, slice[index+deleteCount:]...)

	return output
}
